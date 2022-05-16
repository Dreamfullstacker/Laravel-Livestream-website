<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['title'] 		= __('Services').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'services'; 

        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(collections.id) as total 
            FROM `collections` 
            WHERE collections.privacy = "1"')
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            collections.id,
            collections.name,
            collections.user_id,
            collections.background,
            collections.self,
            collections.playlist,
            collections.service,
            collections.color,
            users.username,
            users.avatar,
            IFNULL(p.toplam, 0) AS toplam
            FROM `collections` 
            LEFT JOIN (
              SELECT collection_id, count(collections_post.content_id) AS toplam
              FROM collections_post
              GROUP BY collection_id
            ) p ON (collections.id = p.collection_id)
            LEFT JOIN users ON users.id = collections.user_id
            WHERE collections.privacy = "1" AND collections.service = "1" 
            ORDER BY collections.id DESC 
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/'.$Config['nav'].'?page=[page]');
		
        $Config['url']          = APP.'/'.$Config['nav']; 
		$this->setVariable("Config", $Config);
		$this->setVariable("Listings", $Listings);
		$this->setVariable("Pagination", $Pagination);
		$this->setVariable("TotalRecord", $TotalRecord);
		$this->view('services', 'app');
	}
}
