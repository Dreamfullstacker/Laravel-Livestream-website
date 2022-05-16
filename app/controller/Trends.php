<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trends extends Controller
{
    public function process()
    {
        $AuthUser               = $this->getVariable("AuthUser");
        $Route                  = $this->getVariable("Route");
        $Settings               = $this->getVariable("Settings");  


        $Config['nav']          = 'trends'; 
  
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            COUNT(posts.id) as total 
            FROM `posts` 
            '.$Join.'
            '.$Where.'')
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            posts.id, 
            posts.title, 
            posts.image, 
            posts.self, 
            posts.type, 
            posts.quality, 
            posts.status,
            posts.created
            FROM `posts` 
            LEFT JOIN posts_category ON posts_category.content_id = posts.id  
            LEFT JOIN categories ON categories.id = posts_category.category_id  
            WHERE posts.status = "1"
            GROUP BY posts.id
            '.$OrderBy.'
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/discovery'.$SearchPage.'page=[page]');
         
        $Config['title']        = get($Settings, "data.discovery_title", "seo");
        $Config['description']  = get($Settings, "data.discovery_description", "seo");
        $Config['url']          = APP.'/discovery'; 
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination);  
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Categories', $Categories);  
        $this->setVariable('Countries', $Countries);  
        $this->setVariable("Config", $Config);
        $this->setVariable("Filter", $Filter);
        $this->view('trends', 'app');
    }

}
