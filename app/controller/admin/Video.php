<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Video extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Config['title']            = TITLE;
        $Config['description']      = DESC;
        $Config['nav']              = 'settings';

        require_once PATH . '/config/array.config.php';
        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('videos_option')->where('id',$Route->params->id,'=')->first();
        }

        $this->setVariable("Backgrounds", $Backgrounds);
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_action']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_action']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('video', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $dataarray          = array(
                "name"                  => Input::cleaner($_POST['name']),
                "type"                  => Input::cleaner($_POST['type']),
                "icon"                 => Input::cleaner($_POST['icon'])
            );   
            $this->db->insert('videos_option')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/videos');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $dataarray          = array(
                "name"                  => Input::cleaner($_POST['name']),
                "type"                  => Input::cleaner($_POST['type']),
                "icon"                 => Input::cleaner($_POST['icon'])
            );   
            $this->db->update('videos_option')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/videos');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
