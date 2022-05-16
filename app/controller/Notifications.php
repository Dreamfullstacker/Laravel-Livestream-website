<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Notifications').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'main';

        $Notifications     		= $this->db->from('notifications')->where('user_id',$AuthUser['id'],'=')->limit(0,20)->orderby('id','DESC')->all();
		$this->setVariable("Config", $Config);
		$this->setVariable("Notifications", $Notifications);
		$this->view('notifications', 'app');
	}
}
