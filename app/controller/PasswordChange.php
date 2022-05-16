<?php
defined('BASEPATH') or exit('No direct script access allowed'); 
class PasswordChange extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Reset Password').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'main';
        if($Route->params->hash) {
            $User = $this->db->from('users')->where('email',Input::hasher('decode',$Route->params->hash))->first();
            if(!$User['id']) {
                header("location: " . APP."/login");
            }
            $this->setVariable("User", $User);
        }else{ 
            header("location: " . APP."/login");
        }
        if(Input::cleaner($_POST['_ACTION']) == 'change') { 
            $Notify['type'] = 'success';
            $Notify['text'] = __('Your password has been sent to your e-mail address !');
            $this->notify($Notify);
            header("location: " . APP."/login");
             
        }
        if(Input::cleaner($_POST['_ACTION']) == 'change' AND $User['id']) {
            $this->update();
        }
		$this->setVariable("Config", $Config);
		$this->view('password.change', 'app');
	}

    public function update() { 
        $User = $this->getVariable("User");      
        if (mb_strlen($_POST['password']) < 6 AND Input::cleaner($_POST['password'])) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Password must be at least 6 characters');
            $this->notify($Notify);
        }
        if (empty($Notify)) {   
            $dataarray          = array( 
                "password"      => Input::cryptor($_POST['password'])
            );   
            $this->db->update('users')->where('id',$User['id'])->set($dataarray); 
 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/login');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
}