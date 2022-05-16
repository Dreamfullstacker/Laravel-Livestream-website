<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 

        // Query 
 
        if(Input::cleaner($Route->params->self)) {
            $Listing        = $this->db->from('pages')->where('self',$Route->params->self,'=')->first();
        }

		$Config['title'] 		= $Listing['name'].' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
        $Config['type']         = 'page';  
        $Config['url']          = page($Listing['id'],$Listing['self']); 
        $this->setVariable("Config",$Config);      
        $this->setVariable('Listing',$Listing);
		$this->view('page', 'app');
	}
}
