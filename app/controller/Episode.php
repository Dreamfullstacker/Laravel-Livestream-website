<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Episode extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
        $Config['nav']          = 'series'; 
		if ($Route->params->id) {
	        $Listing = $this->db->from(null,'
	            SELECT 
	            posts.id, 
	            posts.title, 
	            posts.title_sub, 
                posts.description, 
		posts_episode.overview,
                posts.self, 
	            categories.name,
	            posts.image, 
                posts_episode.hit, 
                posts.trailer,
	            posts.status,
	            posts.imdb_id,
                posts.create_year,
		posts.end_year,
		posts.series_status,
		posts.mpaa,
		posts.quality,
                posts.imdb,
                posts.type, 
 posts.private,
posts.politicy,
	            posts.data,
                posts.comment,
	            posts.created,
                posts.duration,
                countries.name as country_name,
                posts_episode.id as episode_id,
                posts_episode.hit as episode_hit,
                posts_episode.season_id as season_id,
                posts_season.name as season_name,
                posts_episode.name as episode_name,
                posts_episode.description as episode_description,
                (SELECT 
                COUNT(reactions.content_id) 
                FROM reactions 
                WHERE reactions.reaction = "up" AND content_id = posts.id) AS likes, 
                (SELECT 
                COUNT(reactions.content_id) 
                FROM reactions 
                WHERE reactions.reaction = "down" AND content_id = posts.id) AS dislikes
	            FROM `posts` 
                LEFT JOIN posts_season ON posts.id = posts_season.content_id AND posts_season.content_id IS NOT NULL
                LEFT JOIN posts_episode ON posts_season.id = posts_episode.season_id AND posts_episode.content_id IS NOT NULL
	            LEFT JOIN posts_category ON posts_category.content_id = posts.id  
	            LEFT JOIN categories ON categories.id = posts_category.category_id  
                LEFT JOIN countries ON countries.id = posts.country  
	            WHERE posts.id = "'. $Route->params->id .'" AND posts.status = "1" AND posts_episode.name = "'.$Route->params->episode.'" AND posts_season.name = "'.$Route->params->season.'"
	            '.$OrderBy)
	            ->first();
            if(!$Listing['id']) {
                header("location: ".APP.'/404');
            }
            $Data       = json_decode($Listing['data'], true);
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

            $Next = $this->db->from(null,'
                SELECT 
                posts.description, 
                posts.self,
                posts_season.name as season_name,
                posts_episode.name as episode_name
                FROM `posts` 
                LEFT JOIN posts_season ON posts.id = posts_season.content_id AND posts_season.content_id IS NOT NULL
                LEFT JOIN posts_episode ON posts_season.id = posts_episode.season_id AND posts_episode.content_id IS NOT NULL
                WHERE posts.id = "'. $Route->params->id .'" AND posts_episode.id = (select min(id) from posts_episode where id > "'.$Listing['episode_id'].'" ORDER BY cast(posts_episode.name as unsigned) ASC) 
                ORDER BY cast(posts_episode.name as unsigned) ASC')
                ->first();
            $Prev = $this->db->from(null,'
                SELECT 
                posts.description, 
                posts.self,
                posts_season.name as season_name,
                posts_episode.name as episode_name
                FROM `posts` 
                LEFT JOIN posts_season ON posts.id = posts_season.content_id AND posts_season.content_id IS NOT NULL
                LEFT JOIN posts_episode ON posts_season.id = posts_episode.season_id AND posts_episode.content_id IS NOT NULL 
                WHERE posts.id = "'. $Route->params->id .'" AND posts_episode.id = (select max(id) from posts_episode where id < "'.$Listing['episode_id'].'" ORDER BY cast(posts_episode.name as unsigned) ASC) 
                ORDER BY cast(posts_episode.id as unsigned) ASC')
                ->first();
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

            if($AuthUser['id']) {
                $Collection = $this->db->from('collections_post')
                ->where('content_id',Input::cleaner($Listing['id']))
                ->where('user_id',Input::cleaner($AuthUser['id']))
                ->first();
            }
            if($Route->params->video) {
                $RouteVideo = ($Route->params->video-1);
            } else {
                $RouteVideo = 0;
            } 

            // Season
            $Seasons = $this->db->from(null,'
                SELECT 
                posts_season.id,  
                posts_season.name
                FROM `posts_season`
                WHERE posts_season.content_id = "'.$Listing['id'].'"
                ORDER BY cast(name as unsigned) ASC')
                ->all(); 
            $Likes          = $Listing['likes'];
            $Dislikes       = $Listing['dislikes'];
            $TotalReaction  = $Likes + $Dislikes;
            $Likes          = round($Likes / $TotalReaction * 100);
 
        }
        require PATH . '/config/array.config.php'; 
	 
		
		$Config['title'] 		= str_replace('${title}', $Listing['title'], get($Settings, "data.serie_title", "seo"));
        $Config['title']        = str_replace('${episode}', $Listing['episode_name'], $Config['title']);
        $Config['title']        = str_replace('${season}', $Listing['season_name'], $Config['title']);
        $Config['description']  = str_replace('${title}', $Listing['title'], get($Settings, "data.serie_description", "seo"));
        $Config['description']  = str_replace('${episode}', $Listing['episode_name'], $Config['description']);
        $Config['description']  = str_replace('${season}', $Listing['season_name'], $Config['description']);
        $Config['type']         = 'episode';  
        $Config['ogtype']       = 'video.episode';  
        $Config['share']        = true;  
        $Config['image']        = UPLOAD.'/cover/'.$Listing['image'];  
        $Config['url']          = episode($Listing['id'],$Listing['self'],$Listing['season_name'],$Listing['episode_name']);  
        $Config['id']           = $Listing['episode_id'];  
        $Config['player']       = true;  
        $Config['comments']     = true;  
        
		$this->setVariable("Config", $Config);
        $this->setVariable('Listing', $Listing);
        $this->setVariable('Categories', $Categories);
	$this->setVariable('Data', $Data);
        $this->setVariable('Actors', $Actors); 
        $this->setVariable('Next', $Next); 
        $this->setVariable('Prev', $Prev); 
        $this->setVariable('Follow', $Follow); 
        $this->setVariable('Likes', $Likes);   
        $this->setVariable('Similars', $Similars); 
        $this->setVariable('Seasons', $Seasons); 
        $this->setVariable('Vote', $Vote); 
		$this->view('episode', 'app');
	}
}
