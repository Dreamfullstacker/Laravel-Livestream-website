<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends Controller {
	public function process() {
		$AuthUser 	= $this->getVariable("AuthUser");
		$Route 		= $this->getVariable("Route");
		$Settings 	= $this->getVariable("Settings"); 
		$Config['nav']		= 'main';  
        $Comments = $this->db->from(null,'
            SELECT 
            comments.id,
            comments.comment,
            comments.created,
            comments.status,
            comments.url,
            comments.user_id,
            u.name,
            u.avatar,
            p.title,
            p.type
            FROM `comments`  
            LEFT JOIN users AS u ON comments.user_id = u.id AND comments.user_id IS NOT NULL
            LEFT JOIN posts AS p ON comments.content_id = p.id AND comments.content_id IS NOT NULL 
            ORDER BY comments.id DESC  
            LIMIT 0,6')
            ->all();

        $ReportsListing = $this->db->from(null,'
            SELECT 
            reports.id,
            reports.report_id,
            reports.body,
            reports.url,
            reports.created,
            reports.status
            FROM `reports`  
            ORDER BY reports.id DESC  
            LIMIT 0,6')
            ->all();

        $RequestsListing = $this->db->from(null,'
            SELECT 
            *
            FROM requests')
            ->all();

        $Total['movies']        = $this->db->from(null,'SELECT count(posts.id) as total FROM `posts` WHERE type = "movie"')->total(); 
        $Total['series']        = $this->db->from(null,'SELECT count(posts.id) as total FROM `posts` WHERE type = "serie"')->total(); 
        $Total['episodes']      = $this->db->from(null,'SELECT count(posts_episode.id) as total FROM `posts_episode`')->total(); 
        $Total['users']         = $this->db->from(null,'SELECT count(users.id) as total FROM `users`')->total(); 
        $Total['actors']        = $this->db->from(null,'SELECT count(actors.id) as total FROM `actors`')->total(); 
        $Total['discussions']   = $this->db->from(null,'SELECT count(discussions.id) as total FROM `discussions`')->total(); 
        $Total['comments']      = $this->db->from(null,'SELECT count(comments.id) as total FROM `comments`')->total();
        $Total['reports']       = $this->db->from(null,'SELECT count(reports.id) as total FROM `reports`')->total();
        $Total['requests']      = $this->db->from(null,'SELECT count(requests.id) as total FROM `requests`')->total();

        require_once PATH.'/config/array.config.php';
        $this->setVariable("Reports", $Reports);
		$this->setVariable("Config", $Config);
		$this->setVariable("Total", $Total);
		$this->setVariable("Comments", $Comments);
		$this->setVariable("ReportsListing", $ReportsListing);
		$this->setVariable("RequestsListing", $RequestsListing);
		$this->view('main', 'admin');
	}
}
