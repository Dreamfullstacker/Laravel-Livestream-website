<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actors extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Actors').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
        $Config['nav']          = 'actors'; 

        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(actors.id) as total 
            FROM `actors`')
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            actors.id,
            actors.name,
            actors.self,
            actors.image
            FROM `actors`    
            ORDER BY actors.name asc
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/'.$Config['nav'].'?page=[page]');
		
        $Config['url']          = APP.'/'.$Config['nav'];  
		$this->setVariable("Config", $Config);
		$this->setVariable("Listings", $Listings);
		$this->setVariable("Pagination", $Pagination);
		$this->setVariable("TotalRecord", $TotalRecord);
		$this->view('actors', 'app');
	}
}
