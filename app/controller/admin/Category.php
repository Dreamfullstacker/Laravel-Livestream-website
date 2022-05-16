<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends Controller
{
    public function process()
    {
        $AuthUser           = $this->getVariable("AuthUser");
        $Route              = $this->getVariable("Route"); 
        $Config['nav']      = 'categories';

        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('categories')->where('id',$Route->params->id,'=')->first();
        }

        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('category', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $dataarray          = array(
                "name"                  => Input::cleaner($_POST['name']),
                "self"                  => Input::seo($_POST['name']),
                "description"           => Input::cleaner($_POST['description']),
                "color"                 => Input::cleaner($_POST['color']),
                "featured"              => Input::cleaner($_POST['featured'],2),
                "footer"                => Input::cleaner($_POST['footer'],2),
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->insert('categories')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/categories');
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
                "description"           => Input::cleaner($_POST['description']),
                "color"                 => Input::cleaner($_POST['color']),
                "featured"              => Input::cleaner($_POST['featured'],2),
                "footer"                => Input::cleaner($_POST['footer'],2),
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('categories')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/categories');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
