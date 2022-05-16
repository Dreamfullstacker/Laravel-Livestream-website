<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collection extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route"); 
        $Config['nav']              = 'collections';
 
        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('collections')->where('id',$Route->params->id,'=')->first();
            // Videos 
            $Collections = $this->db->from(
                null,
                '
                SELECT 
                collections_post.id, 
                a.id as content_id,
                a.title,  
                a.type,  
                a.self,   
                a.image
                FROM `collections_post` 
                LEFT JOIN posts AS a ON collections_post.content_id = a.id     
                WHERE collections_post.collection_id = "' . $Listing['id'] . '"
                ORDER BY collections_post.sortable ASC'
            )->all();
        }
 
        $this->setVariable("Config",$Config);    
        $this->setVariable('Listing',$Listing); 
        $this->setVariable('Collections',$Collections); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        }

        $this->view('collection', 'admin');
    }

    public function save() { 
        $AuthUser           = $this->getVariable("AuthUser");   
        if (empty($Notify)) {  
   
            $dataarray          = array(
                "name"                  => Input::cleaner($_POST['name']),
                "self"                  => Input::seo($_POST['name']),
                "user_id"               => $AuthUser['id'],
                "color"                 => Input::cleaner($_POST['color']),
                "background"            => Input::cleaner($_POST['background']),
                "privacy"               => Input::cleaner($_POST['privacy'],1),
                "featured"              => Input::cleaner($_POST['featured'],2),
                "service"               => Input::cleaner($_POST['service']),
                "featuredservice"               => Input::cleaner($_POST['featuredservice']),
                "playlist"               => Input::cleaner($_POST['playlist']),
                "featuredplaylist"               => Input::cleaner($_POST['featuredplaylist']),
                'created'       => date('Y-m-d H:i:s')
            );       
            $this->db->insert('collections')->set($dataarray); 
            $LastId = $this->db->lastId();

            // Collection    
            foreach ($_POST['collection'] as $Collection) {
                if (!$Collection['id']) {
                    $dataarray = array(
                        "collection_id"     => $LastId,
                        "content_id"        => Input::cleaner($Collection['content_id'])
                    );
                    $this->db->insert('collections_post')->set($dataarray);
                }
            }
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/collections');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
    public function update() {
        $AuthUser           = $this->getVariable("AuthUser");  
        $Listing            = $this->getVariable("Listing");       
        if (empty($Notify)) {
            
            $dataarray          = array(
                "name"                  => Input::cleaner($_POST['name']),
                "self"                  => Input::seo($_POST['name']),
                "user_id"               => $AuthUser['id'],
                "color"                 => Input::cleaner($_POST['color']),
                "background"            => Input::cleaner($_POST['background']),
                "privacy"               => Input::cleaner($_POST['privacy'],1),
                "featured"              => Input::cleaner($_POST['featured'],2),
                "service"               => Input::cleaner($_POST['service']),
                "featuredservice"               => Input::cleaner($_POST['featuredservice']),
                "playlist"               => Input::cleaner($_POST['playlist']),
                "featuredplaylist"               => Input::cleaner($_POST['featuredplaylist'])
            );     
            $this->db->update('collections')->where('id',$Listing['id'])->set($dataarray);

            // Collection    
            foreach ($_POST['collection'] as $Collection) { 
                if ($Collection['id'] AND $Collection['content_id']) {
                    $dataarray = array(
                        "collection_id"     => $Listing['id'],
                        "content_id"        => Input::cleaner($Collection['content_id'])
                    );
                    $this->db->update('collections_post')->where('id', Input::cleaner($Video['id']))->set($dataarray);
                } elseif (!$Collection['id'] AND $Collection['content_id']) {
                    $dataarray = array(
                        "collection_id"     => $Listing['id'],
                        "content_id"        => Input::cleaner($Collection['content_id'])
                    );
                    $this->db->insert('collections_post')->set($dataarray);
                }
            }
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/collections');
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
