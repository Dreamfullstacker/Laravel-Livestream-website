<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serie extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Config['title'] = TITLE;
        $Config['description'] = DESC;
        $Config['nav'] = 'series';

        $Categories     = $this->db->from('categories')->orderby('name', 'ASC')->all();
        $Countries      = $this->db->from('countries')->orderby('name', 'ASC')->all();
        if ($Route->params->id) {
            $Listing    = $this->db->from('posts')->where('id', $Route->params->id)->first();
            $Data       = json_decode($Listing['data'], true);
            $Seasons    = $this->db->from('posts_season')->where('content_id', $Listing['id'])->orderby('sortable','ASC')->all(); 
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
            $MovieCategories = $this->db->from('posts_category')->where('content_id', $Listing['id'])->all();
            foreach ($MovieCategories as $MovieCategory) {
                $SelectCategories[] = $MovieCategory['category_id'];
            }
        }
        require PATH . '/config/array.config.php';
        $this->setVariable('Listing', $Listing);
        $this->setVariable('Categories', $Categories);
        $this->setVariable('Actors', $Actors); 
        $this->setVariable('SelectCategories', $SelectCategories);
        $this->setVariable('Seasons', $Seasons);
        $this->setVariable('Qualities', $Qualities);
        $this->setVariable('Countries', $Countries);
        $this->setVariable('Data', $Data);
        $this->setVariable("Config", $Config);

        // Actions
        if ($Listing['id'] and $_POST['_ACTION'] == 'save') {
            $this->update();
        } elseif ($_POST['_ACTION'] == 'save') {
            $this->save();
        }

        $this->view('serie', 'admin');
    }

    public function save()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if (empty($Notify)) {
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $Settings['data'][$key] = $value;
                }
            }
            if($_POST['image-url']) {
                $Path = UPLOADPATH . '/tmp/' . Input::seo($_POST['title']) . '.jpg';
                downloader($_POST['image-url'], $Path);
                $_FILES['image'] = $Path;
            }
            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['title']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = MOVIE_X;
                $foo->image_y = MOVIE_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/cover/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['image']);
                    $thumb->allowed = array('image/*');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-' . Input::seo($_POST['title']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_MOVIE_X;
                    $thumb->image_y = THUMB_MOVIE_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->jpeg_quality = 100;
                    $thumb->Process(UPLOADPATH . '/cover/');
                    unlink($Path);
                }
            }

            $foo = new \Verot\Upload\Upload($_FILES['cover']);
            if ($foo->uploaded) {
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = 'cover-'.Input::seo($_POST['title']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = COVER_X;
                $foo->image_y = COVER_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/cover/');
                if ($foo->processed) {
                    $Cover = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['cover']);
                    $thumb->allowed = array('image/*');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-cover-' . Input::seo($_POST['title']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_COVER_X;
                    $thumb->image_y = THUMB_COVER_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->jpeg_quality = 100;
                    $thumb->Process(UPLOADPATH . '/cover/');

                    $big = new \Verot\Upload\Upload($_FILES['cover']);
                    $big->allowed = array('image/*');
                    $big->file_auto_rename = true;
                    $big->file_new_name_body = 'large-cover-' . Input::seo($_POST['title']);
                    $big->image_resize = true;
                    $big->image_ratio_crop = true;
                    $big->image_x = LARGE_COVER_X;
                    $big->image_y = LARGE_COVER_Y;
                    $big->image_convert = 'webp';
                    $big->jpeg_quality = 100;
                    $big->Process(UPLOADPATH . '/cover/');
                    
                    unlink($Path);
                }
            } 
            $Data = array(
                'type'          => 'serie',
                'title'         => Input::cleaner($_POST['title']),
                'title_sub'     => Input::cleaner($_POST['title_sub']),
                'self'          => Input::seo($_POST['title']),
                'image'         => $Image,
                'cover'         => $Cover,
                'description'   => Input::cleaner($_POST['description']),
                'country'       => Input::cleaner($_POST['country']),
                'imdb'          => Input::cleaner($_POST['imdb']),
                'quality'       => Input::cleaner($_POST['quality']),
                'duration'      => Input::cleaner($_POST['duration']),
                'create_year'   => Input::cleaner($_POST['create_year']),
                'end_year'      => Input::cleaner($_POST['end_year']),
                'series_status'      => Input::cleaner($_POST['series_status']),
                'mpaa'          => Input::cleaner($_POST['mpaa']),
                'trailer'       => Input::cleaner($_POST['trailer']),
                'data'          => json_encode($Settings['data'], JSON_UNESCAPED_UNICODE),
                'private'       => (int)Input::cleaner($_POST['private'], 2),
                'politicy'       => (int)Input::cleaner($_POST['politicy'], 2),
                'comment'       => (int)Input::cleaner($_POST['comment'], 2),
                'featured'      => (int)Input::cleaner($_POST['featured'], 2),
                'anime'      => (int)Input::cleaner($_POST['anime'], 2),
                'status'        => (int)Input::cleaner($_POST['status'], 2), 
                'created'       => date('Y-m-d H:i:s')
            );
            $this->db->insert('posts')->set($Data);

            $LastId = $this->db->lastId();
            if (count($_POST['category']) >= '1') {
                for ($i = 0; $i < count($_POST['category']); $i++) {
                    if (Input::cleaner($_POST['category'][$i])) {
                        $dataarray = array(
                            "category_id" => Input::cleaner($_POST['category'][$i]),
                            "content_id" => $LastId
                        );
                        $this->db->insert('posts_category')->set($dataarray);
                    }
                }
            } 

            // Seasons     
            foreach ($_POST['season'] as $Season) {
                $dataarray = array(
                    "content_id"    => $LastId,
                    "name"          => Input::cleaner($Season['name']),
                    "sortable"      => (int)Input::cleaner($Season['sortable'])
                );
                $this->db->insert('posts_season')->set($dataarray);
            }
            
            // Actors    
            foreach ($_POST['actor'] as $Actor) {
                if (!$Actor['id'] AND $Actor['character_name']) {
                    $CheckActor = $this->db->from('actors')->where('self', Input::seo($Actor['name']))->or_where('api_id', $Actor['api_id'])->first();

                    if (!$CheckActor['id'] AND $Actor['name']) {
                        $Settings['data']['place_of_birth'] = $Actor['place_of_birth'];
                        $Settings['data']['deathday']       = $Actor['deathday'];

                        $Path = UPLOADPATH . '/tmp/' . Input::seo($Actor['name']) . '.jpg';
                        downloader($Actor['image'], $Path);
                        $foo = new \Verot\Upload\Upload($Path);
                        if ($foo->uploaded) {
                            $foo->allowed = array('image/*');
                            $foo->file_auto_rename = true;
                            $foo->file_new_name_body = Input::seo($Actor['name']);
                            $foo->image_resize = true;
                            $foo->image_ratio_crop = true;
                            $foo->image_x = ACTOR_X;
                            $foo->image_y = ACTOR_Y;
                            $foo->jpeg_quality = 100;
                            $foo->Process(UPLOADPATH . '/actor/');
                            if ($foo->processed) {
                                $Image = $foo->file_dst_name;
                                $thumb = new \Verot\Upload\Upload($Path);
                                $thumb->allowed = array('image/*');
                                $thumb->file_auto_rename = true;
                                $thumb->file_new_name_body = 'thumb-' . Input::seo($Actor['name']);
                                $thumb->image_resize = true;
                                $thumb->image_ratio_crop = true;
                                $thumb->image_x = THUMB_ACTOR_X;
                                $thumb->image_y = THUMB_ACTOR_Y;
                                $thumb->jpeg_quality = 100;
                                $thumb->Process(UPLOADPATH . '/actor/');
                            }
                        }
                        $Data = array(
                            'name'      => Input::cleaner($Actor['name']),
                            'self'      => Input::seo($Actor['name']),
                            'image'     => $Image,
                            'biography' => Input::cleaner($Actor['biography']),
                            'gender'    => Input::cleaner($Actor['gender']),
                            'data'      => json_encode($Actor['data'], JSON_UNESCAPED_UNICODE),
                            'api_id'    => Input::cleaner($Actor['api_id']),
                            'imdb_id'   => Input::cleaner($Actor['imdb_id'])
                        );
                        $this->db->insert('actors')->set($Data);
                        $Actor_id = $this->db->lastId();
                    } else {
                        $Actor_id = $CheckActor['id'];
                    }
                    $Check = $this->db->from('posts_actor')->where('content_id', Input::seo($Listing['id']))->where('actor_id', $Actor_id)->first();
                    if (!$Check['id'] AND $Actor_id > 0) {
                        $dataarray = array(
                            "actor_id"          => $Actor_id,
                            "character_name"    => Input::cleaner($Actor['character_name']),
                            "content_id"        => $LastId,
                            "sortable"          => (int)Input::cleaner($Actor['sortable'])
                        );
                        $this->db->insert('posts_actor')->set($dataarray);
                    }
                }
            }
            $Notify['type'] = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: " . APP . '/admin/series');
        } else {
            $this->notify($Notify);
        }
        return $this;
    }

    public function update()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Listing = $this->getVariable("Listing");
        $SelectCategories = $this->getVariable("SelectCategories");
        if (empty($Notify)) {
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $Settings['data'][$key] = $value;
                }
            }
            if($_POST['image-url']) {
                $Path = UPLOADPATH . '/tmp/' . Input::seo($_POST['title']) . '.jpg';
                downloader($_POST['image-url'], $Path);
                $_FILES['image'] = $Path;
            }
            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                unlink(UPLOADPATH . '/cover/' . $Listing['image']);
                unlink(UPLOADPATH . '/cover/thumb-' . $Listing['image']);
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['title']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = MOVIE_X;
                $foo->image_y = MOVIE_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/cover/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['image']);
                    $thumb->allowed = array('image/*');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-' . Input::seo($_POST['title']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_MOVIE_X;
                    $thumb->image_y = THUMB_MOVIE_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->Process(UPLOADPATH . '/cover/');
                }
            } else {
                $Image = $Listing['image'];
            }

            $foo = new \Verot\Upload\Upload($_FILES['cover']);
            if ($foo->uploaded) { 
                unlink(UPLOADPATH . '/cover/' . $Listing['cover']);
                unlink(UPLOADPATH . '/cover/large-' . $Listing['cover']);
                unlink(UPLOADPATH . '/cover/thumb-' . $Listing['cover']);
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = 'cover-'.Input::seo($_POST['title']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = COVER_X;
                $foo->image_y = COVER_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/cover/');
                if ($foo->processed) {
                    $Cover = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['cover']);
                    $thumb->allowed = array('image/*');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-cover-' . Input::seo($_POST['title']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_COVER_X;
                    $thumb->image_y = THUMB_COVER_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->jpeg_quality = 100;
                    $thumb->Process(UPLOADPATH . '/cover/');
                    unlink($Path);
                }
            } else {
                $Cover = $Listing['cover'];
            } 
            $Data = array(
                'type'          => 'serie',
                'title'         => Input::cleaner($_POST['title']),
                'title_sub'     => Input::cleaner($_POST['title_sub']),
                'self'          => Input::seo($_POST['title']),
                'image'         => $Image,
                'cover'         => $Cover,
                'description'   => Input::cleaner($_POST['description']),
                'country'       => Input::cleaner($_POST['country']),
                'imdb'          => Input::cleaner($_POST['imdb']),
                'quality'       => Input::cleaner($_POST['quality']),
                'duration'      => Input::cleaner($_POST['duration']),
                'create_year'   => Input::cleaner($_POST['create_year']),
                'end_year'      => Input::cleaner($_POST['end_year']),
                'series_status'      => Input::cleaner($_POST['series_status']),
                'mpaa'          => Input::cleaner($_POST['mpaa']),
                'trailer'       => Input::cleaner($_POST['trailer']),
                'data'          => json_encode($Settings['data'], JSON_UNESCAPED_UNICODE),
                'private'       => (int)Input::cleaner($_POST['private'], 2),
                'politicy'       => (int)Input::cleaner($_POST['politicy'], 2),
                'comment'       => (int)Input::cleaner($_POST['comment'], 2),
                'featured'      => (int)Input::cleaner($_POST['featured'], 2),
                'anime'      => (int)Input::cleaner($_POST['anime'], 2),
                'status'        => (int)Input::cleaner($_POST['status'], 2)  
            );
            $this->db->update('posts')->where('id', $Listing['id'])->set($Data);
            // Category
            if (count($_POST['category']) >= '1') { 
                foreach ($SelectCategories as $Key => $Value) {  
                    if (!in_array($Value, $_POST['category'])) {  
                        $this->db->delete('posts_category')->where('id', $Value, '=')->done();
                    }
                }
                for ($i = 0; $i < count($_POST['category']); $i++) {
                    if (!in_array($_POST['category'][$i], $SelectCategories)) {
                        $dataarray = array(
                            "category_id"   => Input::cleaner($_POST['category'][$i]),
                            "content_id"      => $Listing['id']
                        );
                        $this->db->insert('posts_category')->set($dataarray);
                    }
                }
            } 
            // Seasons     
            foreach ($_POST['season'] as $Season) {
                if ($Season['id'] AND $Season['name']) {
                    $dataarray = array(
                        "content_id"    => $Listing['id'],
                        "name"          => Input::cleaner($Season['name']),
                        "sortable"      => (int)Input::cleaner($Season['sortable'])
                    );
                    $this->db->update('posts_season')->where('id', Input::cleaner($Season['id']))->set($dataarray);
                } elseif (!$Season['id'] AND $Season['name']) {
                    $dataarray = array(
                        "content_id"    => $Listing['id'],
                        "name"          => Input::cleaner($Season['name']),
                        "sortable"      => (int)Input::cleaner($Season['sortable'])
                    );
                    $this->db->insert('posts_season')->set($dataarray);
                }
            }
            // Actors    
            foreach ($_POST['actor'] as $Actor) {
                if ($Actor['id']) {
                    $dataarray = array(
                        "actor_id"          => Input::cleaner($Actor['actor_id']),
                        "character_name"    => Input::cleaner($Actor['character_name']),
                        "content_id"        => $Listing['id'],
                        "sortable"          => (int)Input::cleaner($Actor['sortable'])
                    );
                    $this->db->update('posts_actor')->where('id', Input::cleaner($Actor['id']))->set($dataarray);
                } elseif (!$Actor['id']) {
                    $CheckActor = $this->db->from('actors')->where('self', Input::seo($Actor['name']))->or_where('api_id', $Actor['api_id'])->first();

                    if (!$CheckActor['id'] AND $Actor['name']) {
                        $Settings['data']['place_of_birth'] = $Actor['place_of_birth'];
                        $Settings['data']['deathday']       = $Actor['deathday'];

                        $Path = UPLOADPATH . '/tmp/' . Input::seo($Actor['name']) . '.jpg';
                        downloader($Actor['image'], $Path);
                        $foo = new \Verot\Upload\Upload($Path);
                        if ($foo->uploaded) {
                            $foo->allowed = array('image/*');
                            $foo->file_auto_rename = true;
                            $foo->file_new_name_body = Input::seo($Actor['name']);
                            $foo->image_resize = true;
                            $foo->image_ratio_crop = true;
                            $foo->image_x = ACTOR_X;
                            $foo->image_y = ACTOR_Y;
                            $foo->image_convert = 'webp';
                            $foo->jpeg_quality = 100;
                            $foo->Process(UPLOADPATH . '/actor/');
                            if ($foo->processed) {
                                $Image = $foo->file_dst_name;
                                $thumb = new \Verot\Upload\Upload($Path);
                                $thumb->allowed = array('image/*');
                                $thumb->file_auto_rename = true;
                                $thumb->file_new_name_body = 'thumb-' . Input::seo($Actor['name']);
                                $thumb->image_resize = true;
                                $thumb->image_ratio_crop = true;
                                $thumb->image_x = THUMB_ACTOR_X;
                                $thumb->image_y = THUMB_ACTOR_Y;
                                $thumb->image_convert = 'webp';
                                $thumb->Process(UPLOADPATH . '/actor/');
                            }
                        }
                        $Data = array(
                            'name'      => Input::cleaner($Actor['name']),
                            'self'      => Input::seo($Actor['name']),
                            'image'     => $Image,
                            'biography' => Input::cleaner($Actor['biography']),
                            'gender'    => Input::cleaner($Actor['gender']),
                            'data'      => json_encode($Actor['data'], JSON_UNESCAPED_UNICODE),
                            'api_id'    => Input::cleaner($Actor['api_id']),
                            'imdb_id'   => Input::cleaner($Actor['imdb_id'])
                        );
                        $this->db->insert('actors')->set($Data);
                        $Actor_id = $this->db->lastId();
                    } else {
                        $Actor_id = $CheckActor['id'];
                    }
                    $Check = $this->db->from('posts_actor')->where('content_id', Input::seo($Listing['id']))->where('actor_id', $Actor_id)->first();
                    if (!$Check['id'] AND $Actor_id) {
                        $dataarray = array(
                            "actor_id"          => $Actor_id,
                            "character_name"    => Input::cleaner($Actor['character_name']),
                            "content_id"        => $Listing['id'],
                            "sortable"          => (int)Input::cleaner($Actor['sortable'])
                        );
                        $this->db->insert('posts_actor')->set($dataarray);
                    }
                }
            }

            $Notify['type'] = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
          
            header("location: " . APP . '/admin/series');
           
        } else {
            $this->notify($Notify);
        }
        return $this;
    }
}
