<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Country extends Controller {
	public function process() {

		$str 					= APP . $_SERVER["REQUEST_URI"]; 
		$match 					= substr(strrchr($str, "/"), 1 );
    	$matchthis = str_replace('-', ' ', $match);
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Country').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'country'; 
    
        // Query 
        $Listings = $this->db->from(null,'
            SELECT 
            posts.id, 
            posts.title, 
            posts.title_sub,
            posts.image, 
            posts.self, 
            posts.type, 
            posts.quality, 
            posts.create_year,
            posts.end_year,
            posts.imdb,
            posts.mpaa,
            posts.description,
            posts.status,
            posts.created,
            posts.country,
            countries.id as country_id,
            countries.name
            FROM posts
            INNER JOIN countries ON countries.id = posts.country WHERE countries.name = "'.$matchthis.'"')
            ->all();
         
        $Config['url']          = APP.'/'.$Config['nav'];  
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination);  
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Categories', $Categories);  
        $this->setVariable('SelectCategory', $SelectCategory);  
        $this->setVariable('Filter', $Filter);  
        $this->setVariable("Config", $Config);
        $this->view('country', 'app');
		
        $Config['url']          = APP.'/'.$Config['nav']; 
		$this->setVariable("Config", $Config);
		$this->setVariable("Country", $Countries);
		$this->view('country', 'app');
	}
}
