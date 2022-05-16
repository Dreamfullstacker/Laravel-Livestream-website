<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noting extends Controller {
	public function process() {
		$AuthUser = $this->getVariable("AuthUser");
		$Route = $this->getVariable("Route");
		$Config['title'] 		= __('Page not found');
		$Config['description'] 	= __('Page not found'); 
        $Config['url']          = APP.'/404'; 
		$this->setVariable("Config", $Config);
		$this->view('noting', 'app');
	}
}
