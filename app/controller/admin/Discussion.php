<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discussion extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Config['title']            = TITLE;
        $Config['description']      = DESC;
        $Config['nav']              = 'discussions';
 
        if(Input::cleaner($Route->params->id)) {
            $Listing = $this->db->from(null,'
            SELECT 
            discussions.id,
            discussions.title,
            discussions.created,
            discussions.content_id,
            discussions.status,
            discussions.user_id,
            discussions.body,
            u.name,
            u.avatar,
            u.username,
            posts.title as post_title,
            posts.type
            FROM `discussions`  
            LEFT JOIN users AS u ON discussions.user_id = u.id AND discussions.user_id IS NOT NULL
            LEFT JOIN posts ON discussions.content_id = posts.id AND discussions.content_id IS NOT NULL 
            WHERE discussions.id = "'.$Route->params->id.'"')
            ->first();
        } else {
            header("location: ".APP.'/admin/discussions');
        }

        $this->setVariable("Backgrounds", $Backgrounds);
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_action']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('discussion', 'admin');
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $dataarray          = array(
                "title"                 => Input::cleaner($_POST['title']),
                "body"                  => Input::cleaner($_POST['body']),
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('discussions')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = 'Yorum düzenlendi'; 
            $this->notify($Notify);
            header("location: ".APP.'/admin/discussions');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
