<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discussion extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 

        // Query 
 
        if(Input::cleaner($Route->params->id)) { 
            $Listing = $this->db->from(
                null,
                '
                SELECT 
                discussions.id,
                discussions.title,
                discussions.body,
                discussions.created,
                discussions.status,
                discussions.user_id,
                users.username,
                users.name,
                users.avatar,
                discussions.content_id,
                categories.name as category_name,
                posts.title as post_title,
                posts.type,
                posts.self,
                posts.image
                FROM `discussions`  
                LEFT JOIN users ON discussions.user_id = users.id AND discussions.user_id IS NOT NULL 
                LEFT JOIN posts ON discussions.content_id = posts.id AND discussions.content_id IS NOT NULL
                LEFT JOIN posts_category ON posts_category.content_id = posts.id  
                LEFT JOIN categories ON categories.id = posts_category.category_id  
                WHERE discussions.id = "' . $Route->params->id . '"'
            )->first();
        } 

        $Config['nav']          = 'discussions'; 
        $Config['title']        = $Listing['title'].' - '.get($Settings, "data.title", "general");
        $Config['description']  = get($Settings, "data.description", "general");
        $Config['type']         = 'discussion'; 
        $Config['id']           = $Listing['id'];  
        $Config['url']          = discussion($Listing['id'],$Listing['self']); 
        $Config['comments']     = true;  
        $this->setVariable("Data", $Data);
        $this->setVariable("Config",$Config);    
        $this->setVariable("Posts",$Posts);      
        $this->setVariable('Listing',$Listing);
		$this->view('discussion', 'app');
	}
}
