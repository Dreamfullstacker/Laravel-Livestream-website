<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Chat').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'chat'; 

        // Query 
        $Countries = $this->db->from(null,'
            SELECT 
            countries.id,
            countries.name
            FROM `countries`
            ORDER BY name ASC')
            ->all();
		
        $Config['url']          = APP.'/'.$Config['nav']; 
		$this->setVariable("Config", $Config);
		$this->setVariable("Chat", $Countries);
		$this->view('chat', 'app');
	}
}
