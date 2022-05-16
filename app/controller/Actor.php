<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actor extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['nav'] 			= 'actors'; 

        // Query 
 
        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('actors')->where('id',$Route->params->id,'=')->first();
            $Data           = json_decode($Listing['data'], true);

            // Videos 
            $Posts = $this->db->from(
                null,
                '
                SELECT 
                posts_actor.id, 
                posts_actor.character_name, 
		a.quality,
		a.imdb,
		a.create_year,
		a.end_year,
		a.mpaa,
		a.description,
                a.id as content_id,
                a.title,  
                a.type,  
                a.self,   
                a.image
                FROM `posts_actor` 
                LEFT JOIN posts AS a ON posts_actor.content_id = a.id     
                WHERE posts_actor.actor_id = "' . $Listing['id'] . '"
                ORDER BY posts_actor.sortable ASC'
            )->all();
        }
        $Config['title']        = str_replace('${title}', $Listing['name'], get($Settings, "data.actor_title", "seo"));
        $Config['description']  = str_replace('${title}', $Listing['name'], get($Settings, "data.actor_description", "seo"));

        $Config['type']         = 'actor'; 
        $Config['url']          = actor($Listing['id'],$Listing['self']);  
        $this->setVariable("Data", $Data);
        $this->setVariable("Config",$Config);    
        $this->setVariable("Posts",$Posts);      
        $this->setVariable('Listing',$Listing);
		$this->view('actor', 'app');
	}
}
