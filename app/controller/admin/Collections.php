<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collections extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");    
        $Config['nav']                  = 'collections';
        $Config['page']                 = 'collection';

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
            'featured',
            'privacy',
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
                    $Where .= ' collections.'.$key.' = "'.$value.'" AND ';
                }
            }
            $Where = $WhereC.' '.rtrim($Where,' AND ');   
        } elseif($Filter['search']) {
            $Where .= 'WHERE ';
            $Where .= 'collections.name LIKE "%'.$Filter['search'].'%" AND'; 
            $Where = rtrim($Where,' AND ');  
        }
        $Where = rtrim($Where,' AND '); 
 
        if($Filter['sortable']) { 
            $OrderBy = 'ORDER BY collections.id '.$Filter['sortable'];
        }else{
            $OrderBy = 'ORDER BY collections.id DESC';
        }      
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(collections.id) as total 
            FROM `collections`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            collections.id,
            collections.name,
            collections.created,
            collections.user_id,
            collections.privacy,
            collections.color,
            u.name as user_name,
            u.avatar
            FROM `collections`  
            LEFT JOIN users AS u ON collections.user_id = u.id AND collections.user_id IS NOT NULL
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
            $this->db->delete('collections')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/collections');
        }  
        $this->view('collections', 'admin');
    }
}
