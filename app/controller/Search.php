<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends Controller
{
    public function process()
    {
        $AuthUser               = $this->getVariable("AuthUser");
        $Route                  = $this->getVariable("Route");
        $Settings               = $this->getVariable("Settings"); 
        $isValid                = $this->getVariable("isValid");  

        if (Input::cleaner($_POST['_ACTION']) == 'search' AND $isValid) {
            header("location: ".APP.'/search/'.Input::cleaner($_POST['q']));
        }elseif(!$Route->params->q){
            header("location: ".APP);
        }
  
        $Config['title']        = urldecode($Route->params->q).' - '.get($Settings, "data.title", "general");
        $Config['description']  = get($Settings, "data.description", "general");
 
  
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            COUNT(posts.id) as total 
            FROM `posts` 
            '.$Join.'
            '.$Where.'')
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Movies = $this->db->from(null,'
            SELECT 
            posts.id, 
            posts.title, 
            categories.name,
            categories.self as category_self,
            posts.image, 
            posts.self, 
            posts.title_sub, 
            posts.type, 
            posts.quality, 
            posts.status,
            posts.created
            FROM `posts` 
            LEFT JOIN posts_category ON posts_category.content_id = posts.id  
            LEFT JOIN categories ON categories.id = posts_category.category_id  
            WHERE posts.status = "1" AND posts.type = "movie" AND posts.title LIKE "%'.urldecode($Route->params->q).'%" 
            GROUP BY posts.id
            ORDER BY posts.hit DESC
            LIMIT 0,50')
            ->all(); 

        $Series = $this->db->from(null,'
            SELECT 
            posts.id, 
            posts.title, 
            categories.name,
            categories.self as category_self,
            posts.image, 
            posts.self, 
            posts.type, 
            posts.quality, 
            posts.title_sub, 
            posts.status,
            posts.created
            FROM `posts` 
            LEFT JOIN posts_category ON posts_category.content_id = posts.id  
            LEFT JOIN categories ON categories.id = posts_category.category_id  
            WHERE posts.status = "1" AND posts.type = "serie" AND posts.title LIKE "%'.urldecode($Route->params->q).'%" 
            GROUP BY posts.id
            ORDER BY posts.hit DESC
            LIMIT 0,50')
            ->all(); 
         
        $Actors = $this->db->from(null,'
            SELECT 
            actors.id,
            actors.name,
            actors.self,
            actors.image
            FROM `actors`    
            WHERE actors.name LIKE "%'.urldecode($Route->params->q).'%"  
            ORDER BY actors.name ASC
            LIMIT 0,50')
            ->all(); 
        $Config['url']          = APP.'/search/'.Input::cleaner($Route->params->q); 
        $this->setVariable('Movies', $Movies);  
        $this->setVariable('Actors', $Actors); 
        $this->setVariable('Series', $Series);    
        $this->setVariable("Config", $Config);
        $this->view('search', 'app');
    }

}
