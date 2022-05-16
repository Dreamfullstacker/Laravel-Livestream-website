<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slide extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route"); 
        $Config['nav']              = 'slider';

        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('slider')->where('id',$Route->params->id,'=')->first();
        }

        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('slide', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['title']);
                $foo->image_resize = false;
                $foo->image_ratio_crop = true;
                $foo->image_x = SLIDE_X;
                $foo->image_y = SLIDE_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/slide/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name; 
                }
            }
            $dataarray          = array(
                "title"         => Input::cleaner($_POST['title']),
                "body"          => Input::cleaner($_POST['body']),
                "content_id"    => Input::cleaner($_POST['content_id']),
                "image"         => $Image,
                "link"          => Input::cleaner($_POST['link']), 
                "status"        => Input::cleaner($_POST['status'],2),
                "created"       => date('Y-m-d H:i:s')
            );   
            $this->db->insert('slider')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/slider');
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
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['title']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = SLIDE_X;
                $foo->image_y = SLIDE_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/slide/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name; 
                }
            }else{
                $Image = $Listing['image'];
            }
            $dataarray          = array(
                "title"         => Input::cleaner($_POST['title']),
                "body"          => Input::cleaner($_POST['body']),
                "content_id"    => Input::cleaner($_POST['content_id'],$Listing['content_id']),
                "image"         => $Image,
                "link"          => Input::cleaner($_POST['link']), 
                "status"        => Input::cleaner($_POST['status'],2),
                "created"       => date('Y-m-d H:i:s')
            );   
            $this->db->update('slider')->where('id',$Listing['id'])->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/slider');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
