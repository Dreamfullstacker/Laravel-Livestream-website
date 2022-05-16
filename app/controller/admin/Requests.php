<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");   

        $Config['nav']                  = 'requests';
        $Config['page']                 = 'request';
  
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(requests.id) as total 
            FROM `requests`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            requests.id,
            requests.title,
            requests.url,
            requests.type,
            requests.status
            FROM `requests`  
            '.$Where.'  
            '.$OrderBy.'  
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/'.$Config['nav'].$SearchPage.'page=[page]');
 
        require_once PATH.'/config/array.config.php';
        $this->setVariable("Requests", $Requests);
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Config', $Config);   

        $Submit         = json_decode($_GET['submit'], true);  

        if($Submit['id'] AND $Submit['_ACTION'] == 'delete') {
            $this->db->delete('requests')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/requests');
        }  
        $this->view('requests', 'admin');
    }
}
