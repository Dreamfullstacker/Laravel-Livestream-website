<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Country extends Controller
{
    public function process()
    {
        $AuthUser           = $this->getVariable("AuthUser");
        $Route              = $this->getVariable("Route"); 
        $Config['nav']      = 'settings';

        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('countries')->where('id',$Route->params->id,'=')->first();
        }

        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('country', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $dataarray          = array(
                "name"          => Input::cleaner($_POST['name']), 
                "language"      => Input::cleaner($_POST['language'])
            );   
            $this->db->insert('countries')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/countries');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $dataarray          = array(
                "name"          => Input::cleaner($_POST['name']), 
                "language"      => Input::cleaner($_POST['language'])
            );   
            $this->db->update('countries')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/countries');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
