<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends Controller {
    
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		if (!$AuthUser['id'] and !\Delight\Cookie\Cookie::exists('Auth')) {
            header("location: " . APP);
        }
		$Config['title'] 		= __('Settings').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'main';

		$this->setVariable("Config", $Config);
		$this->setVariable("Notifications", $Notifications);

        if(Input::cleaner($_POST['_ACTION']) == 'save' AND $AuthUser['id']) {
            $this->update();
        }
		$this->view('settings', 'app');
	}

    public function update() { 
         $AuthUser = $this->getVariable("AuthUser");      
        if (mb_strlen($_POST['password']) < 6 AND Input::cleaner($_POST['password'])) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Password must be at least 6 characters');
            $this->notify($Notify);
        }
        $EmailCheck      = $this->db->from('users')->where('email',Input::cleaner($_POST['email']),'=','AND')->first();
        if (Input::cleaner($_POST['email']) == $EmailCheck['email'] AND $AuthUser['email'] != $EmailCheck['email']) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Email already registered !');
            $this->notify($Notify);
        }
        if (empty($Notify)) {   

            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                unlink(UPLOADPATH . '/user/'.$Listing['avatar']);
                unlink(UPLOADPATH . '/user/thumb-'.$AuthUser['avatar']);
                $foo->allowed               = array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
                $foo->file_auto_rename      = true;
                $foo->file_new_name_body    = Input::seo($_POST['name']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = USER_X;
                $foo->image_y = USER_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/user/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['image']);
                    $thumb->allowed = array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-' . Input::seo($_POST['name']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_USER_X;
                    $thumb->image_y = THUMB_USER_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->jpeg_quality = 100;
                    $thumb->Process(UPLOADPATH . '/user/');
                    unlink($Path);
                }
            } else {
                $Image = $AuthUser['avatar'];
            }
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $SettingsData['data'][$key] = $value;
                }
            }

            if(Input::cleaner($_POST['password'])) {
                $Password = Input::cryptor($_POST['password']);
            }else{
                $Password = $AuthUser['password'];
            }

            $dataarray          = array(
                "name"          => Input::cleaner($_POST['name']), 
                "email"         => Input::cleaner($_POST['email']), 
                "language"      => Input::cleaner($_POST['language']), 
                "password"      => $Password, 
                "avatar"        => $Image,
                'data'          => json_encode($SettingsData['data'], JSON_UNESCAPED_UNICODE),
            );   
            $this->db->update('users')->where('id',$AuthUser['id'])->set($dataarray); 
 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/settings');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
}
