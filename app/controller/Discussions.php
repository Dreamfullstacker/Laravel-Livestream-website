<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discussions extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
        $isValid                = $this->getVariable("isValid"); 
		$Settings 				= $this->getVariable("Settings"); 
        $Config['title']        = __('Discussions').' - '.get($Settings, "data.title", "general");
        $Config['description']  = get($Settings, "data.description", "general");
		$Config['nav'] 			= 'discussions'; 
 
        $Where = 'WHERE discussions.status = "1"';
        // Query 
        $TotalRecord        = $this->db->from(null,'
            SELECT 
            count(discussions.id) as total 
            FROM `discussions`   
            '.$Where)
            ->total(); 
        $LimitPage          = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM); 
   
        $Listings = $this->db->from(null,'
            SELECT 
            discussions.id,
            discussions.self,
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
            '.$Where.'  
            ORDER BY discussions.id DESC
            LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
            ->all();
        $Pagination         = $this->db->showPagination(APP.'/tartismalar?page=[page]');

        $Config['url']          = APP.'/discussions'; 
		$this->setVariable("Config", $Config);
		$this->setVariable("Listings", $Listings);
		$this->setVariable("Pagination", $Pagination);
		$this->setVariable("TotalRecord", $TotalRecord);
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND $isValid AND $AuthUser['id']) { 
            $this->save();
        }
		$this->view('discussions', 'app');
	}

    public function save() { 
        $AuthUser = $this->getVariable("AuthUser");
        $Settings = $this->getVariable("Settings");
        if (empty($Notify)) {   
            $dataarray          = array(
                "user_id"		=> Input::cleaner($AuthUser['id']),
                "title"			=> Input::cleaner($_POST['title']),
                "self"			=> Input::seo($_POST['title']),
                "body"			=> Input::cleaner($_POST['body']),
                "content_id"	=> Input::cleaner($_POST['content_id']),
                "status"		=> (get($Settings,'data.discussion','general') == 1 ? 2 : 1),
                'created'       => date('Y-m-d H:i:s')
            );   
            $this->db->insert('discussions')->set($dataarray); 
            $Notify['type']     = 'success';
            $Notify['text']     = __('New Thread opened'); 
            $this->notify($Notify);
            header("location: ".discussion($this->db->lastId(),Input::seo($_POST['title'])));
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
}
