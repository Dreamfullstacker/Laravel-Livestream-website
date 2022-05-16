<?php
/**
 * 
 */
class Comments extends Controller {  
    public function process() {     
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		if($_GET['action'] == 'get') {
			$this->getcomments();
		} elseif($_POST['action'] == 'post') {
			$this->comment();
		} elseif($_POST['action'] == 'vote') {
			$this->vote();
		} elseif($_POST['action'] == 'update') {
			$this->comment();
		}
    } 

    public function vote() { 
		$AuthUser 	= $this->getVariable("AuthUser");
		if($AuthUser['id']) {
			$Vote = $this->db->from('comments_reaction')->where('user_id',$AuthUser['id'])->where('comment_id',$_POST['id'])->first();
			if(Input::cleaner($_POST['type']) == '-up' || Input::cleaner($_POST['type']) == '-down') {
	            $this->db->delete('comments_reaction')->where('id',$Vote['id'],'=')->done(); 
			} elseif($Vote['id']) {
		        $dataarray          = array(
		            "reaction"			=> Input::cleaner($_POST['type'])
		        );   
		        $this->db->update('comments_reaction')->where('id',$Vote['id'])->set($dataarray);  
	    	} elseif(!$Vote['id']) {
		        $dataarray          = array(
		            "user_id"			=> $AuthUser['id'],
		            "comment_id"		=> Input::cleaner($_POST['id']),
		            "reaction"			=> Input::cleaner($_POST['type'])
		        );   
		        $this->db->insert('comments_reaction')->set($dataarray);  
	    	}
    	}
    	return true;
    }
    public function comment() {  
        header('Access-Control-Allow-Origin: *');
		header("Content-type: application/json; charset=utf-8");
		$AuthUser 	= $this->getVariable("AuthUser");
		$Settings 	= $this->getVariable("Settings");
		if(Input::cleaner($_POST['id']) AND Input::cleaner($_POST['comment']) AND $AuthUser['id']) {
	        $dataarray          = array(
	            "comment"        => htmlspecialchars(Input::cleaner($_POST['comment']))
	        );   
	        $this->db->update('comments')->where('id',Input::cleaner($_POST['id']))->where('user_id',$AuthUser['id'])->set($dataarray);  
			$Listing = $this->db->from('comments')->where('user_id',$AuthUser['id'])->where('id',Input::cleaner($_POST['id']))->first();
			$comment = [
				'id'            => Input::cleaner($Listing['id']),
				'comment'		=> Input::cleaner($Listing['comment']), 
				'parent_id'		=> $Listing['parent_id'],
				'likes'			=> 0,
				'dislikes'		=> 0,
				'voted'			=> null,
				'edit'			=> true,
				'author'		=> array(
					'name' 		=> $AuthUser['username'],
					'email' 	=> $AuthUser['email'],
					'avatar' 	=> trim(gravatar($AuthUser['id'],$AuthUser['avatar'],$AuthUser['name'],'avatar avatar-sm')),
					'url' 		=> profile($AuthUser['id'],$AuthUser['username']),
				),
				'created'		=> timeago($Listing['created']),
				'spoiler'		=> (int)Input::cleaner($_POST['spoiler'],0), 
				'status'		=> (get($Settings,'data.comment','general') == 1 ? 2 : 1),
				'replies'		=> $this->getreplies($Listing['id'])
			];  
		}else{
			if(!Input::cleaner($_POST['comment']) || Input::cleaner(mb_strlen($_POST['comment'])) < 10) {
				header('X-PHP-Response-Code: 404', true, 404);
				$comment[] = __('Comment must be at least 10 characters.');
			}else {
				if(Input::cleaner($_POST['type']) == 'post') {
					$Type = 'post';
					$Content = $this->db->from('posts')->where('id',Input::cleaner($_POST['content_id']))->first();
					if($Content['type'] == 'serie') {
	                	$Notification['data']['link']   = post($Content['id'],$Content['self'],$Content['type']);
	                } elseif($Content['type'] == 'movie') {
	                	$Notification['data']['link']   = post($Content['id'],$Content['self'],$Content['type']);
	                }
				} elseif(Input::cleaner($_POST['type']) == 'discussion') {
					$Type = 'discussion';
					$Content = $this->db->from('discussions')->where('id',Input::cleaner($_POST['content_id']))->first();
					if($AuthUser['id'] != $Content['user_id'] AND !$_POST['parent_id']) {
		                $Notification['data']['link']   = discussion($Content['id'],$Content['self']);
		                $Notification['data']['text']   = $AuthUser['username'].' '.__('commented on the discussion');
		                $dataarray = array(
		                    "user_id"       => $Content['user_id'],
		                    "type"          => 'discussion',
		                    'data'          => json_encode($Notification['data'], JSON_UNESCAPED_UNICODE),
		                    'created'       => date('Y-m-d H:i:s'),
	                    	"status"        => '2'
		                );
		                $this->db->insert('notifications')->set($dataarray);
	                }
				} elseif(Input::cleaner($_POST['type']) == 'channel') {
					$Type = 'channel';
				}  elseif(Input::cleaner($_POST['type']) == 'actor') {
					$Type = 'actor';
				} elseif(Input::cleaner($_POST['type']) == 'episode') {
					$Type = 'episode'; 

			        $Content = $this->db->from(null,'
			            SELECT 
			            posts.id, 
			            posts.self, 
			            posts_episode.name as episode_name, 
			            posts_season.name as season_name
			            FROM `posts_episode` 
		                LEFT JOIN posts ON posts_episode.content_id = posts.id AND posts_episode.content_id IS NOT NULL
		                LEFT JOIN posts_season ON posts_episode.season_id = posts_season.id AND posts_episode.content_id IS NOT NULL
			            WHERE posts_episode.id = "'. $_POST['content_id'] .'" AND posts.status = "1"')
			            ->first();
	                $Notification['data']['link']   = episode($Content['id'],$Content['self'],$Content['season_name'],$Content['episode_name']);
				}
		        $dataarray          = array(
		            "user_id"        => $AuthUser['id'],
		            "content_id"     => Input::cleaner($_POST['content_id']),
		            "parent_id"      => (int)Input::cleaner($_POST['parent_id'],0),
		            "type"        	 => $Type,
		            "comment"        => Input::cleaner($_POST['comment']),
		            "spoiler"        => (int)Input::cleaner($_POST['spoiler'],0),
		            "status"         => (get($Settings,'data.comment','general') == 1 ? 2 : 1),
		            "created"		 => date('Y-m-d H:i:s')
		        );   
		        $this->db->insert('comments')->set($dataarray);  
		        if($_POST['parent_id']) {  	
					$Comment = $this->db->from('comments')->where('id',Input::cleaner($_POST['parent_id']))->first();
		        	if($AuthUser['id'] != $Comment['user_id']) {
		                $Notification['data']['text']   = $AuthUser['username'].' '.__('replied to your comment');
		                $dataarray = array(
		                    "user_id"       => $Comment['user_id'],
		                    "type"          => 'comment',
		                    'data'          => json_encode($Notification['data'], JSON_UNESCAPED_UNICODE),
		                    'created'       => date('Y-m-d H:i:s'),
	                    	"status"        => '2'
		                );
		                $this->db->insert('notifications')->set($dataarray);
		            }
		        }
				$comment = [
					'id'            => $this->db->lastId(),
					'comment'		=> Input::cleaner($_POST['comment']), 
					'parent_id'		=> $_POST['parent_id'],
					'reply'			=> $_POST['parent_id'],
					'likes'			=> 0,
					'dislikes'		=> 0,
					'voted'			=> null,
					'edit'			=> true,
					'author'		=> array(
						'name' 		=> $AuthUser['username'],
						'email' 	=> $AuthUser['email'],
						'avatar' 	=> trim(gravatar($AuthUser['id'],$AuthUser['avatar'],$AuthUser['name'],'avatar avatar-sm')),
						'url' 		=> profile($AuthUser['id'],$AuthUser['username']),
					),
					'spoiler'		=> Input::cleaner($_POST['spoiler']), 
					'created'		=> timeago(date('Y-m-d H:i:s')),
					'status'		=> (get($Settings,'data.comment','general') == 1 ? 2 : 1),
				]; 
	  		}
        }
		echo json_encode($comment);
    }
 
    public function getcomments() {  
		$AuthUser 	= $this->getVariable("AuthUser");

        header('Access-Control-Allow-Origin: *');
		header("Content-type: application/json; charset=utf-8");

        $Page = Input::cleaner($_GET['page']); 
        $Sort = Input::cleaner($_GET['sort']); 
 
		 
 
    	$TotalRecord        = $this->db->from(null,'
            SELECT 
            count(comments.id) as total 
            FROM `comments`
            WHERE comments.parent_id = "0" AND comments.content_id = "'.Input::cleaner($_GET['content_id']).'" AND comments.status = "1" AND comments.type = "'.Input::cleaner($_GET['type']).'"')
            ->total();
        if($Sort == 1) {
        	$Order = 'comments.created DESC';
        }elseif($Sort == 2) {
        	$Order = 'comments.created ASC';
        }elseif($Sort == 3) {
        	$Order = 'likes DESC';
        }else{
        	$Order = 'comments.created DESC';
        }
        $LimitPage  = $this->db->pagination($TotalRecord, '10','page');  
        $Comments 	= $this->db->from(null,'
            SELECT 
            comments.id,
            comments.comment,
            comments.content_id,
            comments.created,
            comments.status,
            comments.parent_id,
            comments.user_id,
            comments.spoiler,
            comments.created,
            u.name,
            u.avatar,
            u.username,
            (SELECT 
            COUNT(comments_reaction.comment_id) 
            FROM comments_reaction 
            WHERE comments_reaction.reaction = "up" AND comment_id = comments.id) AS likes, 
            (SELECT 
            COUNT(comments_reaction.comment_id) 
            FROM comments_reaction 
            WHERE comments_reaction.reaction = "down" AND comment_id = comments.id) AS dislikes
            FROM `comments`  
            LEFT JOIN users AS u ON comments.user_id = u.id AND comments.user_id IS NOT NULL
            WHERE comments.parent_id = "0" AND comments.content_id = "'.Input::cleaner($_GET['content_id']).'" AND comments.status = "1" AND comments.type = "'.Input::cleaner($_GET['type']).'"
            ORDER BY '.$Order.'
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
		foreach ($Comments as $Comment) {  
			if($AuthUser['id']) {
				$Vote = $this->db->from('comments_reaction')->where('user_id',$AuthUser['id'])->where('comment_id',$Comment['id'])->first();
			}


			$comments[] = [
				'id'			=> $Comment['id'],
				'comment'		=> $Comment['comment'],
				'parent_id'		=> $Comment['parent_id'],
				'likes'			=> $Comment['likes'],
				'dislikes'		=> $Comment['dislikes'],
				'voted'			=> ($Vote['id'] ? $Vote['reaction'] : null),
				'edit'			=> ($AuthUser['id'] == $Comment['user_id'] ? true : null),
				'author'		=> array(
					'name' 		=> $Comment['username'],
					'email' 	=> $Comment['email'],
					'avatar' 	=> trim(gravatar($Comment['id'],$Comment['avatar'],$Comment['name'],'avatar avatar-sm')),
					'url' 		=> profile($Comment['user_id'],$Comment['username']),
				),
				'spoiler'		=> $Comment['spoiler'],
				'created'		=> timeago($Comment['created']),
				'status'		=> $Comment['status'],
				'replies'		=> $this->getreplies($Comment['id'])
			]; 
		} 
			$pagination = [
				'total'						=> $TotalRecord,
				'per_page'					=> (int)$LimitPage['limit'],
				'current_page'				=> (int)$Page,
				'last_page'					=> $LimitPage['page_count'],
				'next_page'					=> ($Page + 1 < $LimitPage['page_count'] ? $Page + 1 : $LimitPage['page_count']),
				'prev_page'					=> ($Page - 1 > 0 ? $Page - 1 : 1),
				'first_adjacent_page'		=> 1,
				'last_adjacent_page'		=> 2,
			];
	  
		echo json_encode(array(
			"total"			=> $TotalRecord,
			"comments"  	=> $comments,
			"pagination"  	=> $pagination
		));
    }

    public function getreplies($comment_id = null) {  
		$AuthUser 	= $this->getVariable("AuthUser"); 
    	$TotalRecord        = $this->db->from(null,'
            SELECT 
            count(comments.id) as total 
            FROM `comments`
            WHERE comments.parent_id = "'.$comment_id.'" AND comments.content_id = "'.Input::cleaner($_GET['content_id']).'" AND comments.status = "1"')
            ->total();
   
        $Comments 	= $this->db->from(null,'
            SELECT 
            comments.id,
            comments.comment,
            comments.content_id,
            comments.created,
            comments.status,
            comments.parent_id,
            comments.spoiler,
            comments.user_id,
            comments.created,
            u.name,
            u.avatar,
            u.username,
            (SELECT 
            COUNT(comments_reaction.comment_id) 
            FROM comments_reaction 
            WHERE comments_reaction.reaction = "up" AND comment_id = comments.id) AS likes, 
            (SELECT 
            COUNT(comments_reaction.comment_id) 
            FROM comments_reaction 
            WHERE comments_reaction.reaction = "down" AND comment_id = comments.id) AS dislikes
            FROM `comments`  
            LEFT JOIN users AS u ON comments.user_id = u.id AND comments.user_id IS NOT NULL
            WHERE comments.parent_id = "'.$comment_id.'" AND comments.content_id = "'.Input::cleaner($_GET['content_id']).'" AND comments.status = "1"
            ORDER BY comments.created ASC')
            ->all();
		foreach ($Comments as $Comment) {  

			if($AuthUser['id']) {
				$Vote = $this->db->from('comments_reaction')->where('user_id',$AuthUser['id'])->where('comment_id',$Comment['id'])->first();
			}

			$comments[] = [
				'id'			=> $Comment['id'],
				'comment'		=> $Comment['comment'],
				'parent_id'		=> $Comment['parent_id'],
				'likes'			=> $Comment['likes'],
				'dislikes'		=> $Comment['dislikes'],
				'voted'			=> ($Vote['id'] ? $Vote['reaction'] : null),
				'edit'			=> ($AuthUser['id'] == $Comment['user_id'] ? true : null),
				'author'		=> array(
					'name' 		=> $Comment['username'],
					'email' 	=> $Comment['email'],
					'avatar' 	=> trim(gravatar($Comment['id'],$Comment['avatar'],$Comment['name'],'avatar avatar-sm')),
					'url' 		=> profile($Comment['user_id'],$Comment['username']),
				),
				'spoiler'		=> $Comment['spoiler'],
				'created'		=> timeago($Comment['created']),
				'status'		=> $Comment['status'],
			]; 
		} 
		return $comments;
    }
}