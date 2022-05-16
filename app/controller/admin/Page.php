<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route"); 
        $Config['nav']              = 'pages';

        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('pages')->where('id',$Route->params->id,'=')->first();
        }

        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('page', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $dataarray          = array(
                "name"                  => Input::cleaner($_POST['name']),
                "self"                  => Input::seo($_POST['name']),
                "body"                  => Input::cleaner(htmlspecialchars($_POST['body'])),
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->insert('pages')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/pages');
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
                "self"                  => Input::seo($_POST['name']),
                "body"                  => Input::cleaner(htmlspecialchars($_POST['body'])),
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('pages')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved');  
            $this->notify($Notify);
            header("location: ".APP.'/admin/pages');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
