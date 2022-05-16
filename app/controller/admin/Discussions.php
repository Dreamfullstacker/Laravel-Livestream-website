<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discussions extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");   
        $Config['title']                = 'Oyuncular - Admin Paneli';
        $Config['nav']                  = 'discussions';
        $Config['page']                 = 'discussion';
  
        
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
                    $Where .= ' discussions.'.$key.' = "'.$value.'" AND ';
                }
            }
            $Where = $WhereC.' '.rtrim($Where,' AND ');  
        } elseif($Filter['search']) {
            $Where .= 'WHERE ';
            $Where .= 'discussions.title LIKE "%'.$Filter['search'].'%" AND'; 
            $Where = rtrim($Where,' AND ');  
        }
        $Where = rtrim($Where,' AND ');  
        if($Filter['sortable']) { 
            $OrderBy = 'ORDER BY discussions.id '.$Filter['sortable'];
        }else{
            $OrderBy = 'ORDER BY discussions.id DESC';
        }      
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(discussions.id) as total 
            FROM `discussions`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
    
        $Listings = $this->db->from(null,'
            SELECT 
            discussions.id, 
            discussions.created,
            discussions.title,
            discussions.user_id,
            discussions.status,
            u.username,
            u.name,
            u.avatar,
            p.title as post_title,
            p.type
            FROM `discussions`  
            LEFT JOIN users AS u ON discussions.user_id = u.id AND discussions.user_id IS NOT NULL
            LEFT JOIN posts AS p ON discussions.content_id = p.id AND discussions.content_id IS NOT NULL 
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
            $this->db->delete('discussions')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/discussions');
        }  
        $this->view('discussions', 'admin');
    }
}
