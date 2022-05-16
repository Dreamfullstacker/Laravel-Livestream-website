<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Categories').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'categories'; 

        // Query 
        $Listings = $this->db->from(null,'
            SELECT 
            categories.id,
            categories.name,
            categories.self,
            categories.color
            FROM `categories`
            ORDER BY featured,name ASC')
            ->all();
		
        $Config['url']          = APP.'/'.$Config['nav']; 
		$this->setVariable("Config", $Config);
		$this->setVariable("Listings", $Listings);
		$this->view('categories', 'app');
	}
}
