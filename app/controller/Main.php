<?php
defined('BASEPATH') or exit('No direct script access allowed');
 

class Main extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 		= get($Settings, "data.title", "main");
 
 

        $HomeModules        = $this->db->from("modules")->where('page','home')->where('status',1)->orderby('sortable','ASC')->all();

		$this->setVariable("Config", $Config);
		$this->setVariable("HomeModules", $HomeModules);
		$this->setVariable("Categories", $Categories);
        $Config['url']          = APP; 
		$this->view('main', 'app');
	}
}