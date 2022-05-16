<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Videos extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");   
        $Config['title']                = 'Video Ayarları - Admin Paneli'; 
        $Config['nav']                  = 'settings';
        $Config['page']                 = 'video';
  
        
        // Filter
        $Filter             = json_decode($_GET['filter'], true);  
        if($_POST['search']) {
            $Filter['search'] = $_POST['search'];
            header("location: ".APP.'/admin/videos?filter='.json_encode($Filter));
        }
        if($_POST['_ACTION'] == 'filter') {
            foreach ($_POST as $key => $value) {
                if($value) {
                    $Filter[$key] = $value;
                }
            }
            if(count($Filter) > 1) {
                header("location: ".APP.'/admin/videos?filter='.json_encode($Filter));
            } else {
                header("location: ".APP.'/admin/videos');
            }
        }

        if(count($Filter) >= 1) {
            $SearchPage     = '?filter='.htmlspecialchars($_GET['filter']).'&';
        }else{
            $SearchPage     = '?';
        } 
        if($Filter['search']) {
            $Where .= 'WHERE ';
            $Where .= 'videos_option.name LIKE "%'.$Filter['search'].'%" AND'; 
            $Where = rtrim($Where,' AND ');  
        } 
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(videos_option.id) as total 
            FROM `videos_option`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            videos_option.id,
            videos_option.name,
            videos_option.type
            FROM `videos_option` 
            '.$Where.'  
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/videos'.$SearchPage.'page=[page]');
 
        
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('Config', $Config); 
        $this->setVariable('TotalRecord', $TotalRecord); 

        $Submit         = json_decode($_GET['submit'], true);  

        if($Submit['id'] AND $Submit['_ACTION'] == 'delete') {
            $this->db->delete('videos_option')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/videos');
        }  
        $this->view('videos', 'admin');
    }
}
