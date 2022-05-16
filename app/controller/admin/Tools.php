<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tools extends Controller {
	public function process() {
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");   
        $Config['nav']                  = 'tools';
        $Config['page']                 = 'tool';

        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(tools.id) as total 
            FROM `tools`   
            WHERE status = "1"')
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT *
            FROM `tools`
            WHERE status = "1"
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/admin/'.$Config['nav'].$SearchPage.'page=[page]');
 
        
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Pagination', $Pagination); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('TotalRecord', $TotalRecord); 
        $this->setVariable('Config', $Config);   
		$this->view('tools', 'admin');
	}
}
