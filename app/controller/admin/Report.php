<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Config['title']            = TITLE;
        $Config['description']      = DESC;
        $Config['nav']              = 'reports';
 
        if(Input::cleaner($Route->params->id)) {
            $Listing = $this->db->from(null,'
            SELECT 
            reports.id,
            reports.report_id,
            reports.body,
            reports.user as username,
            reports.created,
            reports.url,
            reports.status,
            posts.title,
            posts.type
            FROM `reports`
            LEFT JOIN posts ON reports.content_id = posts.id AND reports.content_id IS NOT NULL 
            WHERE reports.id = "'.$Route->params->id.'"')
            ->first();
        } else {
            header("location: ".APP.'/admin/reports');
        }
 
        require_once PATH.'/config/array.config.php';
        $this->setVariable("Reports", $Reports);
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_action']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('report', 'admin');
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $dataarray          = array(
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('reports')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/reports');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
