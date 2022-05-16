<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Languages extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");   
        $Config['nav']                  = 'languages';
        $Config['page']                 = 'language';
  
        
        // Query
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(languages.id) as total 
            FROM `languages`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            languages.id,
            languages.name,
            languages.short_name,
            languages.status
            FROM `languages` 
            '.$Where.' 
            '.$OrderBy.' 
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/'.$Config['nav'].$SearchPage.'page=[page]');
 
        
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('Config', $Config); 
        $this->setVariable('TotalRecord', $TotalRecord); 

        $Submit         = json_decode($_GET['submit'], true);  

        if($Submit['id'] AND $Submit['_ACTION'] == 'delete') {
            $this->db->delete('languages')->where('id',$Submit['id'],'=')->done(); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Deletion is successful'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/languages');
        }  
        $this->view('languages', 'admin');
    }
}
