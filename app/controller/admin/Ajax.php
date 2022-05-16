<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends Controller
{
	public function process()
	{
		$AuthUser 	= $this->getVariable("AuthUser");
		$Route 		= $this->getVariable("Route");

        if ($AuthUser['id'] AND 
        	\Delight\Cookie\Cookie::exists('Auth') AND 
        	\Delight\Cookie\Cookie::get('Auth') == $AuthUser['token'] AND 
        	$AuthUser['account_type'] == 'admin') {
			$this->{$Route->params->ajax}();
		} 
	}
	public function delete() { 
        $Route 		= $this->getVariable("Route"); 
        if($Route->params->action == 'video') {
		    $this->db->delete('posts_video')->where('id',$_POST['id'],'=')->done();
        }elseif($Route->params->action == 'actor') {
		    $this->db->delete('posts_actor')->where('id',$_POST['id'],'=')->done();
        }elseif($Route->params->action == 'season') {
		    $this->db->delete('posts_season')->where('id',$_POST['id'],'=')->done();
        }elseif($Route->params->action == 'collection') {
		    $this->db->delete('collections_post')->where('id',$_POST['id'],'=')->done();
        }elseif($Route->params->action == 'avatar') {
        	$User = $this->db->from('users')->where('id',$_POST['id'])->first();
            unlink(UPLOADPATH . '/user/'.$User['avatar']);
            $dataarray          = array(
                "avatar"        => null
            );   
            $this->db->update('users')->where('id',$User['id'])->set($dataarray); 
        }
	} 

    public function service() {
    	$Listings 	= $this->db->from('videos_option')->where('type','service')->orderby('name','ASC')->all();
		$result[] = [
			'id'            => null,
			'name'          => __('Service')
		];  
		foreach ($Listings as $Listing) { 
			$result[] = [
				'id'            => $Listing['id'],
				'name'          => $Listing['name']
			];  
		}  
		echo json_encode(array(
			"status" 	=> $status,
			"text"		=> $text,
			"data"   	=> $result
		));
    }

    public function language() {
    	$Listings 	= $this->db->from('videos_option')->where('type','language')->orderby('name','ASC')->all();
		$result[] = [
			'id'            => null,
			'name'          => __('Language')
		];  
		foreach ($Listings as $Listing) { 
			$result[] = [
				'id'            => $Listing['id'],
				'name'          => $Listing['name']
			];  
		}  
		echo json_encode(array(
			"status" => $status,
			"error"  => null,
			"data"   => $result
		));
    }


	public function actors() {
        $Route 		= $this->getVariable("Route"); 
        if($_GET['q']) {
	        $Listings = $this->db->from(null,'
	            SELECT *
	            FROM `actors`   
	            WHERE actors.name LIKE "%'.$_GET['q'].'%"
	            ORDER BY name ASC')
	            ->all();  
	            $result = null;
			foreach ($Listings as $Listing) {
				$result[] = [
					'id'            => $Listing['id'],
					'name'          => $Listing['name'],
					'image'         => UPLOAD.'/actor/'.$Listing['image']
				];  
			}
        }
		echo json_encode(array(
		    "status" => $status,
		    "error"  => null,
		    "data"   => $result
		));
	}

	public function actorget() {
        $Route 		= $this->getVariable("Route"); 
        if($_GET['id']) {
	        $Listing = $this->db->from(null,'
	            SELECT *
	            FROM `actors`   
	            WHERE actors.id = "'.$_GET['id'].'"')
	            ->first();  
			$result[] = [
				'id'            => $Listing['id'],
				'name'          => $Listing['name'],
				'image'         => UPLOAD.'/actor/'.$Listing['image'],
				'api_id'        => $Listing['api_id'],
				'imdb_id'       => $Listing['imdb_id']
			];  
		 
			$status 	= 'success';
			$text 		= __('Changes Saved');
        }
		echo json_encode(array(
		    "status" 	=> $status,
		    "text"  	=> $text,
		    "data"   	=> $result
		));
	}

	public function posts() {
        $Route 		= $this->getVariable("Route"); 
        if($_GET['q']) {
	        $Listings = $this->db->from(null,'
	            SELECT *
	            FROM `posts`   
	            WHERE posts.title LIKE "%'.$_GET['q'].'%"
	            ORDER BY title ASC')
	            ->all(); 
			$result = []; 
			foreach ($Listings as $Listing) {
			if($Listing['type'] == 'movie') {
				$Type = __('Movie');
			} elseif($Listing['type'] == 'serie') {
				$Type = __('Serie');
			}
				$result[] = [
					'id'            => $Listing['id'],
					'name'          => $Listing['title'],
					'type'          => $Type,
					'image'         => UPLOAD.'/cover/'.$Listing['image']
				];  
			}
        }
		echo json_encode(array(
		    "status" => $status,
		    "error"  => null,
		    "data"   => $result
		));
	}
	public function post() {
        $Route 		= $this->getVariable("Route"); 
        if($_GET['id']) {
	        $Listing = $this->db->from(null,'
	            SELECT *
	            FROM `posts`   
	            WHERE posts.id = "'.$_GET['id'].'"')
	            ->first();  
			if($Listing['type'] == 'movie') {
				$Type = __('Movie');
			} elseif($Listing['type'] == 'serie') {
				$Type = __('Serie');
			}
			$result[] = [
				'content_id'    => $Listing['id'],
				'type'          => $Listing['type'],
				'type_name'		=> $Type,
				'link'          => post($Listing['id'],$Listing['self'],$Listing['type']),
				'name'          => $Listing['title'],
				'image'         => UPLOAD.'/cover/'.$Listing['image']
			];  
		 
			$status 	= 'success';
			$text 		= __('Changes Saved');
        }
		echo json_encode(array(
		    "status" 	=> $status,
		    "text"  	=> $text,
		    "data"   	=> $result
		));
	}
}