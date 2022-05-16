<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Language extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route"); 
        $Config['nav']              = 'languages';

        require_once PATH . '/config/array.config.php';
        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('languages')->where('id',$Route->params->id,'=')->first();
            if(file_exists(PATH.'/locale/'.$Listing['short_name'].'.php')){ 
                include PATH.'/locale/'.$Listing['short_name'].'.php';
            }else{
                include PATH.'/locale/en.php';
            }
        } else {
            include PATH.'/locale/en.php';
        }
 
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        $this->setVariable("Lang",$Lang);  
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('language', 'admin');
    }

    public function save() { 
        if (empty($Notify)) {  
 
            $dataarray          = array(
                "name"              => Input::cleaner($_POST['name']),
                "short_name"        => Input::cleaner($_POST['short_name']),
                "language_code"     => Input::cleaner($_POST['language_code']),
                "text_direction"    => Input::cleaner($_POST['text_direction']),
                "currency"          => Input::cleaner($_POST['currency']),
                "status"            => (int)Input::cleaner($_POST['status'])
            );   
            $this->db->insert('languages')->set($dataarray); 
            file_put_contents(PATH.'/locale/'.Input::cleaner($_POST['short_name']).'.php', '<?php $Lang = ' . var_export($_POST['lang'], true) . ';');
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/languages');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }

    public function update() { 
        $Languages      = $this->getVariable("Languages"); 
        $Listing      = $this->getVariable("Listing");    
        if (empty($Notify)) {  
 
            $dataarray          = array(
                "name"              => Input::cleaner($_POST['name']),
                "short_name"        => Input::cleaner($_POST['short_name']),
                "language_code"     => Input::cleaner($_POST['language_code']),
                "text_direction"    => Input::cleaner($_POST['text_direction']),
                "currency"          => Input::cleaner($_POST['currency']),
                "status"            => (int)Input::cleaner($_POST['status'])
            );    
            $this->db->update('languages')->where('id',$Listing['id'])->set($Data);

            file_put_contents(PATH.'/locale/'.$Listing['short_name'].'.php', '<?php $Lang = ' . var_export($_POST['lang'], true) . ';');
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/languages');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
}
