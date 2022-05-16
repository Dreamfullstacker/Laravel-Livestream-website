<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Config['title']            = TITLE;
        $Config['description']      = DESC;
        $Config['nav']              = 'requests';
 
        if(Input::cleaner($Route->params->id)) {
            $Listing = $this->db->from(null,'
            SELECT 
            requests.id,
            requests.title,
            requests.type,
            requests.url,
            requests.status
            FROM requests
			WHERE requests.id = "'.$Route->params->id.'"')
            ->first();
        } else {
            header("location: ".APP.'/admin/request');
        }
 
        require_once PATH.'/config/array.config.php';
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_action']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('request', 'admin');
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $dataarray          = array(
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('requests')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/requests');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
