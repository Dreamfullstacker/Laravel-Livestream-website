<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Channels extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings");  

        $Config['title']        = get($Settings, "data.channels_title", "seo");
        $Config['description']  = get($Settings, "data.channels_description", "seo");
        $Config['url']          = APP.'/tv-channels'; 
		$Config['nav'] 			= 'channels'; 


        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            COUNT(channels.id) as total 
            FROM `channels` 
            '.$Join.'
            '.$Where.'')
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            channels.id, 
            channels.name, 
            channels.image,
            channels.self
            FROM `channels` 
            '.$Where.' 
            '.$OrderBy.'
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/'.$Config['nav'].$SearchPage.'page=[page]');
		$this->setVariable("Config", $Config); 
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination);  
        $this->setVariable('TotalRecord', $TotalRecord);  
		$this->view('channels', 'app');
	}
}