<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route"); 
        $Config['nav']              = 'comments';
 
        if(Input::cleaner($Route->params->id)) {
            $Listing = $this->db->from(null,'
            SELECT 
            comments.id,
            comments.comment,
            comments.created,
            comments.status,
            comments.user_id,
            comments.spoiler,
            u.name,
            u.avatar,
            u.username,
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
            WHERE comments.id = "'.$Route->params->id.'"')
            ->first();
        } else {
            header("location: ".APP.'/admin/comments');
        }

        $this->setVariable("Backgrounds", $Backgrounds);
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        if(Input::cleaner($_POST['_action']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('comment', 'admin');
    }
    public function update() {
        $Listing        = $this->getVariable("Listing");       
        if (empty($Notify)) {
            $dataarray          = array(
                "comment"               => Input::cleaner($_POST['comment']),
                "spoiler"               => Input::cleaner($_POST['spoiler'],2),
                "status"                => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('comments')->where('id',$Listing['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/comments');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
