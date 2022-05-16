<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Episodes extends Controller {
	public function process() {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Config['title']            = TITLE;
        $Config['description']      = DESC;
        $Config['nav']              = 'episodes';
        $Config['pages']            = 'episodes/'.$Route->params->id;
        $Config['page']             = 'episode';


        // Filter
        if($_POST['search']) {
            $Filter['search'] = $_POST['search'];
            header("location: ".APP.'/admin/'.$Config['pages'].'?filter='.json_encode($Filter));
        }
        if($_POST['_ACTION'] == 'filter') {
            foreach ($_POST as $key => $value) {
                if($value) {
                    $Filter[$key] = $value;
                }
            }
            if(count($Filter) > 1) {
                header("location: ".APP.'/admin/'.$Config['pages'].'?filter='.json_encode($Filter));
            } else {
                header("location: ".APP.'/admin/'.$Config['pages']);
            }
        }

        $Filter             = json_decode($_GET['filter'], true);  
        
        if($Route->params->id) {
            $Seasons = $this->db->from('posts_season')->where('content_id',$Route->params->id)->orderby('name','ASC')->all();
            $Where .= 'WHERE posts_episode.content_id="'.$Route->params->id.'" AND ';
        }
        

        $FilterPermissions = array(
            'status',
            'featured',
            'season_id',
            'search'
        );
        if(count($Filter) >= 1) {
            $SearchPage     = '?filter='.htmlspecialchars($_GET['filter']).'&';
        }else{
            $SearchPage     = '?';
        } 
        if($Filter['_ACTION'] == 'filter') {  
            foreach ($Filter as $key => $value) {
                if(in_array($key, $FilterPermissions)) { 
                    $Where .= ' posts_episode.'.$key.' = "'.$value.'" AND ';
                }
            }
            $Where = rtrim($Where,' AND ');  
        } elseif($Filter['search']) { 
            $Where .= 'posts_episode.name LIKE "%'.$Filter['search'].'%" AND'; 
            $Where = rtrim($Where,' AND ');  
        }
        $Where = rtrim($Where,' AND ');  
        if($Filter['sortable']) { 
            $OrderBy = 'ORDER BY posts_episode.name ASC';
        }      
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(posts.id) as total 
            FROM `posts_episode`   
            LEFT JOIN posts ON posts.id = posts_episode.content_id 
            '.$Where)
            ->total();    
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            posts_episode.id, 
            posts_episode.name, 
            posts_episode.status as statussub, 
            posts_season.name as season, 
            posts.id as content_id,
            posts.title,
            posts.image,
            posts.status,
            posts_episode.created
            FROM `posts_episode` 
            LEFT JOIN posts ON posts.id = posts_episode.content_id  
            LEFT JOIN posts_season ON posts_season.id = posts_episode.season_id 
            '.$Where.'  
            '.$OrderBy.'
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/'.$Config['pages'].$SearchPage.'page=[page]');
        
        // Delete
        $Submit         = json_decode($_GET['submit'], true);  
        if($Submit['id'] AND $Submit['_ACTION'] == 'delete') {
            $this->db->delete('posts_episode')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/'.$Config['pages']);
        }
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('Seasons', $Seasons); 
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable("Config", $Config);
		$this->view('episodes', 'admin');
	}
}
