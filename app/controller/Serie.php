<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serie extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
        $Config['nav']          = 'series'; 
		if ($Route->params->id) {
	        $Listing = $this->db->from(null,'
	            SELECT 
                distinct posts_category.category_id,
	            posts.id, 
	            posts.title, 
	            posts.title_sub, 
                posts.description, 
                posts.self, 
                posts.type, 
	            categories.name,
	            posts.image, 
                posts.hit, 
                posts.trailer,
                posts.comment,
                posts.duration,
                posts.imdb,
	            posts.status,
                posts.create_year,
		posts.end_year,
		posts.series_status,
		posts.mpaa,
		posts.quality,
		posts.private,
		posts.politicy,
		posts.cover,
	            posts.data,
	            posts.created,
                countries.name as country_name,
                (SELECT 
                COUNT(reactions.content_id) 
                FROM reactions 
                WHERE reactions.reaction = "up" AND content_id = posts.id) AS likes, 
                (SELECT 
                COUNT(reactions.content_id) 
                FROM reactions 
                WHERE reactions.reaction = "down" AND content_id = posts.id) AS dislikes
	            FROM `posts` 
	            LEFT JOIN posts_category ON posts_category.content_id = posts.id  
	            LEFT JOIN categories ON categories.id = posts_category.category_id  
                LEFT JOIN countries ON countries.id = posts.country  
	            WHERE posts.id = "'. $Route->params->id .'" AND posts.status = "1" AND posts.type = "serie"
	            
	            '.$OrderBy)
	            ->first();
            $Data       = json_decode($Listing['data'], true);
            if(!$Listing['id']) {
                header("location: ".APP.'/404');
            }
            if($AuthUser['id']) {
                $Vote = $this->db->from('reactions')->where('user_id',$AuthUser['id'])->where('content_id',$Listing['id'])->first();
            }
            if($AuthUser['id']) {
                $Follow = $this->db->from('follows')->where('user_id',$AuthUser['id'])->where('content_id',$Listing['id'])->first();
            }
            // Actors
            $Actors = $this->db->from(
                null,
                '
                SELECT 
                posts_actor.id, 
                posts_actor.character_name, 
                posts_actor.sortable, 
                a.id as actor_id,
                a.name,  
                a.self,  
                a.api_id,  
                a.image
                FROM `posts_actor` 
                LEFT JOIN actors AS a ON posts_actor.actor_id = a.id     
                WHERE posts_actor.content_id = "' . $Listing['id'] . '"
                ORDER BY posts_actor.sortable ASC'
            )->all(); 


            // Categories 
            $Categories = $this->db->from(
                null,
                '
                SELECT 
                categories.id, 
                categories.name, 
                categories.self
                FROM `posts_category` 
                LEFT JOIN categories ON posts_category.category_id = categories.id     
                WHERE posts_category.content_id = "' . $Listing['id'] . '"
                ORDER BY posts_category.id ASC'
            )->all();

            foreach ($Categories as $Category) {
                $SimilarsCategory .= '"'.$Category['id'].'",';
            } 

            // Similars
            $Similars = $this->db->from(null,'
                SELECT 
                posts.id, 
                posts.title, 
                posts.title_sub, 
                categories.name,
                categories.self as category_self,
                posts.quality, 
                posts.image, 
                posts.self, 
                posts.type, 
                posts.status,
		posts.create_year,
		posts.end_year,
		posts.imdb,
		posts.mpaa,
		posts.description,
		posts.data,
                posts.created
                FROM `posts` 
                LEFT JOIN posts_category ON posts_category.content_id = posts.id  
                LEFT JOIN categories ON categories.id = posts_category.category_id  
                WHERE posts.status = "1" AND posts_category.category_id IN ('.rtrim($SimilarsCategory,',').') AND posts.id NOT IN ('.$Listing['id'].') AND posts.type = "serie"
                GROUP BY posts.id
                '.$OrderBy.'
                LIMIT 0,6')
                ->all();

            $Likes          = $Listing['likes'];
            $Dislikes       = $Listing['dislikes'];
            $TotalReaction  = $Likes + $Dislikes;
            $Likes          = round($Likes / $TotalReaction * 100);

        }
        require PATH . '/config/array.config.php'; 
	 
		
		$Config['title'] 		= str_replace('${title}', $Listing['title'], get($Settings, "data.serie_profile_title", "seo"));
		$Config['description'] 	= str_replace('${title}', $Listing['title'], get($Settings, "data.serie_profile_description", "seo"));
        $Config['type']         = 'post';  
        $Config['id']           = $Listing['id'];  
        $Config['ogtype']       = 'video.movie';  
        $Config['share']        = true;  
        $Config['image']        = UPLOAD.'/cover/'.$Listing['image'];  
        $Config['url']          = post($Listing['id'],$Listing['self'],'serie');  
        $Config['player']       = true;  
        $Config['comments']     = true;  
		$this->setVariable("Config", $Config);
        $this->setVariable('Listing', $Listing);
        $this->setVariable('Categories', $Categories);
        $this->setVariable('Data', $Data);
        $this->setVariable('Actors', $Actors);  
        $this->setVariable('Follow', $Follow); 
        $this->setVariable('Likes', $Likes);
        $this->setVariable('Similars', $Similars); 
        $this->setVariable('Vote', $Vote); 
		$this->view('serie', 'app');
	}
}
