<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Channel extends Controller
{
    public function process()
    {
        $AuthUser           = $this->getVariable("AuthUser");
        $Route              = $this->getVariable("Route"); 
        $Config['nav']      = 'categories';

        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('channels')->where('id',$Route->params->id,'=')->first();
            $Data           = json_decode($Listing['data'], true);
        }

        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        $this->setVariable('Data',$Data); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('channel', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['name']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = CHANNEL_X;
                $foo->image_y = CHANNEL_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/channel/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                }
            }
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $Settings['data'][$key] = $value;
                }
            }
            $dataarray          = array(
                "name"          => Input::cleaner($_POST['name']),
                "self"          => Input::seo($_POST['name']),
                "description"   => Input::cleaner($_POST['description']),
                "image"         => $Image,
                "embed"         => Input::cleaner($_POST['embed']),
                "status"        => Input::cleaner($_POST['status'],2),
                'data'          => json_encode($Settings['data'], JSON_UNESCAPED_UNICODE),
            );   
            $this->db->insert('channels')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/channels');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                unlink(UPLOADPATH . '/channel/'.$Listing['image']); 
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['name']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = CHANNEL_X;
                $foo->image_y = CHANNEL_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/channel/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                }
            }else{
                $Image = $Listing['image'];
            }
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $Settings['data'][$key] = $value;
                }
            }
            $dataarray          = array(
                "name"          => Input::cleaner($_POST['name']),
                "self"          => Input::seo($_POST['name']),
                "description"   => Input::cleaner($_POST['description']),
                "image"         => $Image,
                "embed"         => Input::cleaner($_POST['embed']),
                "status"        => Input::cleaner($_POST['status'],2),
                'data'          => json_encode($Settings['data'], JSON_UNESCAPED_UNICODE),
            );   
            $this->db->update('channels')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/channels');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
