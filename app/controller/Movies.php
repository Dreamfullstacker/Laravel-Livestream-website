<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Movies extends Controller
{
    public function process()
    {
        $AuthUser               = $this->getVariable("AuthUser");
        $Route                  = $this->getVariable("Route");
        $Settings               = $this->getVariable("Settings");  

        $Config['nav']          = 'movies'; 


        $Categories = $this->db->from('categories')->orderby('name','ASC')->all(); 
        

        if($_POST['_ACTION'] == 'filter') { 
            foreach ($_POST as $key => $value) {
                if($value AND $key != '_ACTION') {
                    $Filter[$key] = trim($value);
                }
            }
            if(count($Filter) > 0) {
                header("location: ".APP.'/movies?filter='.json_encode($Filter));
            } else {
                header("location: ".APP.'/movies');
            } 
        }
        $Filter             = json_decode($_GET['filter'], true);  
  
        if($Filter['sorting'] == 'popular') { 
            $OrderBy = 'ORDER BY posts.hit DESC';
            $Config['header']       = __('Popular Movies');
            $Config['title']        = str_replace('${title}', __('Popular'), get($Settings, "data.movies_title", "seo"));
            $Config['description']  = str_replace('${title}', __('Popular'), get($Settings, "data.movies_description", "seo"));
            $SearchPage     = '?sorting=popular&'; 
        }elseif($Filter['sorting'] == 'newest') { 
            $OrderBy = 'ORDER BY posts.id DESC';
            $Config['header']       = __('Newest Movies'); 
            $Config['title']        = str_replace('${title}', __('Newest'), get($Settings, "data.movies_title", "seo"));
            $Config['description']  = str_replace('${title}', __('Newest'), get($Settings, "data.movies_description", "seo"));
            $SearchPage     = '?sorting=newest&';
        }elseif($Filter['sorting'] == 'released') {  
            $OrderBy = 'ORDER BY posts.create_year DESC';
            $Config['header']       = __('Popular Movies');
            $Config['title']        = str_replace('${title}', __('Featured'), get($Settings, "data.movies_title", "seo"));
            $Config['description']  = str_replace('${title}', __('Featured'), get($Settings, "data.movies_description", "seo"));
            $SearchPage     = '?sorting=released&';
        }elseif($Filter['sorting'] == 'imdb') { 
            $OrderBy = 'ORDER BY posts.imdb DESC';
            $Config['header']       = __('Popular Movies');
            $Config['title']        = str_replace('${title}', __('Featured'), get($Settings, "data.movies_title", "seo"));
            $Config['description']  = str_replace('${title}', __('Featured'), get($Settings, "data.movies_description", "seo"));
            $SearchPage     = '?sorting=imdb&';
        }elseif($Filter['sorting'] == 'featured') { 
            $OrderBy = 'ORDER BY posts.featured ASC';
            $Config['header']       = __('Featured Movies');
            $Config['title']        = str_replace('${title}', __('Featured'), get($Settings, "data.movies_title", "seo"));
            $Config['description']  = str_replace('${title}', __('Featured'), get($Settings, "data.movies_description", "seo"));
            $SearchPage     = '?sorting=featured&';
        }else{
            $OrderBy = 'ORDER BY posts.id DESC';
            $Config['header']       = __('Newest Movies');
            $Config['title']        = str_replace('${title}', __('Newest'), get($Settings, "data.movies_title", "seo"));
            $Config['description']  = str_replace('${title}', __('Newest'), get($Settings, "data.movies_description", "seo"));
            $SearchPage     = '?';
        }  


        $Where .= 'WHERE posts.type = "movie" AND posts.status = "1" AND ';
        if($Filter['quality']) {
            $Where .= 'posts.quality = "'.Input::cleaner($Filter['quality']).'" AND ';
        } 
        if($Filter['category']) { 

            $SelectCategory = $this->db->from('categories')->where('id',Input::cleaner($Filter['category']))->first();
            $Where .= 'posts_category.category_id = "'.$SelectCategory['id'].'" AND ';
            $Join  .= 'LEFT JOIN posts_category ON posts_category.content_id = posts.id'; 
            $Config['title']        = str_replace('${title}', $SelectCategory['name'], get($Settings, "data.movies_category_title", "seo"));
            $Config['header']       = $SelectCategory['name'].' '.__('Movies');
            if(!$SelectCategory['description']) {
                $Config['description']  = str_replace('${title}', $SelectCategory['name'], get($Settings, "data.movies_category_description", "seo"));
            }else {
                $Config['description']  = $SelectCategory['description'];
            } 
        } 
        if($Filter['imdb']) {
            $Where .= 'posts.imdb >= "'.Input::cleaner($Filter['imdb']).'" AND ';
        }
        if($Filter['released']) {
            $YearExplode = explode('-',Input::cleaner($Filter['released']));
            $Where .= 'posts.create_year BETWEEN '.$YearExplode[0].' AND '.$YearExplode[1].' AND ';
        }
        if($Where) { 
            $Where = rtrim($Where,' AND ');
        }
        if(count($Where) > 0) {
            $SearchPage = '?filter='.json_encode($Filter).'&';
        } else {
            $SearchPage = '?';
        } 


    
        $Where = rtrim($Where,' AND ');   
  
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
            posts.title_sub, 
            posts.image, 
            posts.quality, 
            posts.self, 
            posts.imdb, 
            posts.create_year,
            posts.mpaa,
            posts.description,
            posts.type, 
            posts.status,
            posts.created,
            categories.name
            FROM `posts` 
            LEFT JOIN posts_category ON posts_category.content_id = posts.id  
            LEFT JOIN categories ON categories.id = posts_category.category_id  
            '.$Where.'
            GROUP BY posts.id
            '.$OrderBy.'
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/'.$Config['nav'].$SearchPage.'page=[page]');
         
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination);  
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Categories', $Categories);  
        $this->setVariable('Filter', $Filter);  
        $this->setVariable("Config", $Config);
        $this->view('movies', 'app');
    }

}
