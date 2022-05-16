<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Onesignal extends Controller {
	public function process() {
		$AuthUser 	= $this->getVariable("AuthUser");
		$Route 		= $this->getVariable("Route");
		$Config['nav'] 			= 'tools';  

        if($_POST['_ACTION']) {
			foreach ($_POST as $key => $value) {
				if($value) {
					$Filter[$key] = $value;
				}
			}
			if(count($Filter) > 1) {
				header("location: ".APP.'/admin/onesignal/'.$_POST['_ACTION'].'?filter='.json_encode($Filter));
			} else {
				header("location: ".APP.'/admin/onesignal');
			}
		}

        $Filter		= json_decode($_GET['filter'], true);  


        $this->setVariable("Config",$Config);  
        $this->setVariable("Filter",$Filter);  
		if(Input::cleaner($_POST['_ACTION']) == 'send') {
            $this->sendnotify();
		} 
		$this->view('onesignal', 'admin');
		
	}  
	public function sendnotify() {
		$Settings 		= $this->getVariable("Settings");
		$headings = array(
            'en' => Input::cleaner($_POST['title'])
        );
		$contents = array(
            'en' => Input::cleaner($_POST['message'])
        );

		$foo = new \Verot\Upload\Upload($_FILES['image']);
		if ($foo->uploaded) { 
			$foo->allowed = array('image/*');
			$foo->file_auto_rename = true;
			$foo->file_new_name_body = Input::cryptor($_POST['title']);
			$foo->image_resize          = true;
			$foo->image_ratio_y         = true;
			$foo->image_x = 600; 
			$foo->jpeg_quality = 100;
			$foo->Process(UPLOADPATH . '/onesignal/');
			if ($foo->processed) {
				$Image = UPLOAD . '/onesignal/'.$foo->file_dst_name; 
			}
		}
		if($Image) {
			$Image = $Image;
		} elseif(Input::cleaner($_POST['image-url'])) {
			$Image = Input::cleaner($_POST['image-url']);
		}

        $data = array(
            'app_id' => get($Settings,'data.onesignal_id','api'),
            'included_segments' => array('All'),
            'contents' => $contents,
            'headings' => $headings,
            'url' => Input::cleaner($_POST['url']),
            'chrome_web_image' => $Image,
            'chrome_big_picture' => $Image
        );
        $data = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://onesignal.com/api/v1/notifications',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HEADER => FALSE,
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic '.get($Settings,'data.onesignal_key','api')
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $Notify['type']     = 'success';
        $Notify['text']     = __('Notification sent'); 
        $this->notify($Notify);
		header("location: ".APP.'/admin/onesignal');

	}
}