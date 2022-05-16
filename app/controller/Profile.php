<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['nav'] 			= 'profile'; 

        if(Input::cleaner($Route->params->username)) {
            $Listing        = $this->db->from('users')->where('username',$Route->params->username,'=')->first();
            $Data           = json_decode($Listing['data'], true);

	        $Collections = $this->db->from(null,'
	            SELECT 
	            collections.id,
	            collections.name,
	            collections.user_id,
	            collections.color,
	            collections.background,
	            collections.self,
	            users.username,
	            users.avatar,
	            IFNULL(p.toplam, 0) AS toplam
	            FROM `collections` 
	            LEFT JOIN (
	              SELECT collection_id, count(collections_post.content_id) AS toplam
	              FROM collections_post 
              GROUP BY collection_id
	            ) p ON (collections.id = p.collection_id)
	            LEFT JOIN users ON users.id = collections.user_id
	            WHERE collections.user_id = "'.$Listing['id'].'"
	            LIMIT 0,30')
	            ->all();

	        $Discussions = $this->db->from(null,'
	            SELECT 
	            discussions.id,
	            discussions.title,
	            discussions.body,
	            discussions.created,
	            discussions.status,
	            discussions.user_id,
	            u.username,
	            u.name,
	            u.avatar,
	            (SELECT 
	            COUNT(comments.content_id) 
	            FROM comments 
	            WHERE comments.type = "discussion" AND content_id = discussions.id) AS replies
	            FROM `discussions`  
	            LEFT JOIN users AS u ON discussions.user_id = u.id AND discussions.user_id IS NOT NULL
	            WHERE discussions.status = "1" AND discussions.user_id = "'.$Listing['id'].'"
	            ORDER BY discussions.id DESC
	            LIMIT 0,30')
	            ->all();
        }

        $TabNav = array(
            'general'   	=>  __('Overview'),
            'collections'	=>  __('Collections'),
            'discussions'   =>  __('Discussions'),
            'likedcontent'   =>  __('Liked Content'),
            'following'   =>  __('Following'),
            'reports'   =>  __('Report Tickets')
        ); 
		$Config['title'] 		= $Listing['username'].' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
        $Config['url']          = profile($Listing['id'],$Listing['username']); 

		$this->setVariable("Config", $Config);
		$this->setVariable("TabNav", $TabNav);
		$this->setVariable("Listing", $Listing);
		$this->setVariable("Data", $Data);
		$this->setVariable("Collections", $Collections);
		$this->setVariable("Discussions", $Discussions);
		$this->view('profile', 'app');
	}
}
