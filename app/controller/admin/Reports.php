<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");   

        $Config['nav']                  = 'reports';
        $Config['page']                 = 'report';
  
        
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
            'report_id', 
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
                    $Where .= ' reports.'.$key.' = "'.$value.'" AND ';
                }
            }
            $Where = $WhereC.' '.rtrim($Where,' AND ');  
        } elseif($Filter['search']) {
            $Where .= 'WHERE ';
            $Where .= 'reports.body LIKE "%'.$Filter['search'].'%" AND'; 
            $Where = rtrim($Where,' AND ');  
        }
        $Where = rtrim($Where,' AND ');  
        if($Filter['sortable']) { 
            $OrderBy = 'ORDER BY reports.id '.$Filter['sortable'];
        }else{
            $OrderBy = 'ORDER BY reports.id DESC';
        }      
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(reports.id) as total 
            FROM `reports`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            reports.id,
            reports.report_id,
            reports.url,
            reports.body,
            reports.created,
            reports.status
            FROM `reports`  
            '.$Where.'  
            '.$OrderBy.'  
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/'.$Config['nav'].$SearchPage.'page=[page]');
 
        require_once PATH.'/config/array.config.php';
        $this->setVariable("Reports", $Reports);
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Config', $Config);   

        $Submit         = json_decode($_GET['submit'], true);  

        if($Submit['id'] AND $Submit['_ACTION'] == 'delete') {
            $this->db->delete('reports')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/reports');
        }  
        $this->view('reports', 'admin');
    }
}
