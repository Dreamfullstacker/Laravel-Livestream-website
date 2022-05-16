<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");    
        $Config['nav']                  = 'comments';
        $Config['page']                 = 'comment';
  
        
        // Filter
        if($_POST['search']) {
            $Filter['search'] = $_POST['search'];
            header("location: ".APP.'/admin/'.$Config['nav'].'?filter='.json_encode($Filter));
        }
        if($_POST['_ACTION'] == 'filter') {
            foreach ($_POST as $key => $value) {
                if($value) {
                    $Filter[$key] = $value;
                }
            }
            if(count($Filter) > 1) {
                header("location: ".APP.'/admin/'.$Config['nav'].'?filter='.json_encode($Filter));
            } else {
                header("location: ".APP.'/admin/'.$Config['nav']);
            }
        }

        $Filter             = json_decode($_GET['filter'], true);  
        

        $FilterPermissions = array(
            'status', 
            'spoiler', 
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
                    $WhereC = 'WHERE '; 
                }
            }
            foreach ($Filter as $key => $value) {
                if(in_array($key, $FilterPermissions)) {
                    $Where .= ' comments.'.$key.' = "'.$value.'" AND ';
                }
            }
            $Where = $WhereC.' '.rtrim($Where,' AND ');  
        } elseif($Filter['search']) {
            $Where .= 'WHERE ';
            $Where .= 'comments.name LIKE "%'.$Filter['search'].'%" AND'; 
            $Where = rtrim($Where,' AND ');  
        }
        $Where = rtrim($Where,' AND ');  
        if($Filter['sortable']) { 
            $OrderBy = 'ORDER BY comments.id '.$Filter['sortable'];
        }else{
            $OrderBy = 'ORDER BY comments.id DESC';
        }      
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(comments.id) as total 
            FROM `comments`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            comments.id,
            comments.comment,
            comments.created,
            comments.status,
            comments.user_id,
            u.name,
            u.avatar,
            posts.title,
            posts.type,
            p.title,
            p.type,
            discussions.title as d_title
            FROM `comments`  
            LEFT JOIN users AS u ON comments.user_id = u.id AND comments.user_id IS NOT NULL
            LEFT JOIN posts ON comments.content_id = posts.id AND comments.type = "post" AND comments.content_id IS NOT NULL 
            LEFT JOIN posts_episode ON comments.content_id = posts_episode.id AND comments.type = "episode" AND comments.content_id IS NOT NULL 
            LEFT JOIN posts AS p ON posts_episode.content_id = p.id AND comments.type = "episode" AND comments.content_id IS NOT NULL 
            LEFT JOIN discussions ON comments.content_id = discussions.id AND comments.type = "discussion" AND comments.content_id IS NOT NULL 
            '.$Where.'  
            '.$OrderBy.'  
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/'.$Config['nav'].$SearchPage.'page=[page]');
 
        
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Config', $Config);   

        $Submit         = json_decode($_GET['submit'], true);  

        if($Submit['id'] AND $Submit['_ACTION'] == 'delete') {
            $this->db->delete('comments')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/comments');
        }
        $this->view('comments', 'admin');
    }
}
