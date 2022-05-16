<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Controller
{
    public function process()
    {
        $AuthUser   = $this->getVariable("AuthUser");
        $Route      = $this->getVariable("Route");
        $ValidForm      = $this->getVariable("ValidForm"); 

        $Config['title']            = TITLE;
        $Config['description']      = DESC;
        $Config['nav']              = 'users';
        $Config['page']             = 'user';
        
        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('users')->where('id',$Route->params->id,'=')->first();
            $Data           = json_decode($Listing['data'], true);
        }
        $this->setVariable('Listing', $Listing); 
        $this->setVariable('Data', $Data);  
        $this->setVariable("Config", $Config);   

        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Listing['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Listing['id']) {
            $this->update();
        } 
        $this->view('user', 'admin');
    }

    public function save() {       
        if (mb_strlen($_POST['password']) < 5 AND Input::cleaner($_POST['password'])) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Password must be at least 6 characters');
            $this->notify($Notify);
        }
        $EmailCheck      = $this->db->from('users')->where('email',Input::cleaner($_POST['email']),'=','AND')->first();
        if ($EmailCheck['email']) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Email already registered !');
            $this->notify($Notify);
        }
        $UsernameCheck      = $this->db->from('users')->where('username',Input::cleaner($_POST['username']),'=','AND')->first();
        if (Input::cleaner($_POST['email']) == $UsernameCheck['username'] AND $Listing['username'] != $UsernameCheck['username']) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Username already registered !');
            $this->notify($Notify);
        }
        if (empty($Notify)) {  
             
               
            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['username']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = USER_X;
                $foo->image_y = USER_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/user/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['image']);
                    $thumb->allowed = array('image/*');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-' . Input::seo($_POST['username']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_USER_X;
                    $thumb->image_y = THUMB_USER_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->jpeg_quality = 100;
                    $thumb->Process(UPLOADPATH . '/user/');
                    unlink($Path);
                }
            }
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $Settings['data'][$key] = $value;
                }
            }
            $dataarray          = array(
                "account_type"  => Input::cleaner($_POST['account_type']),
                "username"      => Input::seo($_POST['username']),
                "name"          => Input::cleaner($_POST['name']), 
                "email"         => Input::cleaner($_POST['email']), 
                "password"      => Input::cryptor($_POST['password']), 
                "avatar"        => $Image,
                "banned"        => (int)Input::cleaner($_POST['banned'],0),
                "chatboxbanreason"      => Input::seo($_POST['chatboxbanreason']),
                'data'          => json_encode($Settings['data'], JSON_UNESCAPED_UNICODE),
            );   
            $this->db->insert('users')->set($dataarray); 
 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/users');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }

    public function update() { 
        $Listing = $this->getVariable("Listing");      
        if (mb_strlen($_POST['password']) < 5 AND Input::cleaner($_POST['password'])) {
            $Notify['type']     = 'warning';
                $Notify['text']     = __('Password must be at least 6 characters');
            $this->notify($Notify);
        }
        $EmailCheck      = $this->db->from('users')->where('email',Input::cleaner($_POST['email']),'=','AND')->first();
        if (Input::cleaner($_POST['email']) == $EmailCheck['email'] AND $Listing['email'] != $EmailCheck['email']) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Email already registered !');
            $this->notify($Notify);
        }
        $UsernameCheck      = $this->db->from('users')->where('username',Input::cleaner($_POST['username']),'=','AND')->first();
        if (Input::cleaner($_POST['email']) == $UsernameCheck['username'] AND $Listing['username'] != $UsernameCheck['username']) {
            $Notify['type']     = 'warning';
            $Notify['text']     = __('Username already registered !');
            $this->notify($Notify);
        }
        if (empty($Notify)) {   

            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {
                unlink(UPLOADPATH . '/user/'.$Listing['avatar']);
                unlink(UPLOADPATH . '/user/thumb-'.$Listing['avatar']);
                $foo->allowed = array('image/*');
                $foo->file_auto_rename = true;
                $foo->file_new_name_body = Input::seo($_POST['name']);
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_x = USER_X;
                $foo->image_y = USER_Y;
                $foo->image_convert = 'webp';
                $foo->jpeg_quality = 100;
                $foo->Process(UPLOADPATH . '/user/');
                if ($foo->processed) {
                    $Image = $foo->file_dst_name;
                    $thumb = new \Verot\Upload\Upload($_FILES['image']);
                    $thumb->allowed = array('image/*');
                    $thumb->file_auto_rename = true;
                    $thumb->file_new_name_body = 'thumb-' . Input::seo($_POST['name']);
                    $thumb->image_resize = true;
                    $thumb->image_ratio_crop = true;
                    $thumb->image_x = THUMB_USER_X;
                    $thumb->image_y = THUMB_USER_Y;
                    $thumb->image_convert = 'webp';
                    $thumb->jpeg_quality = 100;
                    $thumb->Process(UPLOADPATH . '/user/');
                    unlink($Path);
                }
            } else {
                $Image = $Listing['avatar'];
            }
            foreach ($_POST['data'] as $key => $value) {
                if ($value) {
                    $Settings['data'][$key] = $value;
                }
            }
            if(Input::cleaner($_POST['password'])) {
                $Password = Input::cryptor($_POST['password']);
            }else{
                $Password = $Listing['password'];
            }
            $dataarray          = array(
                "account_type"  => Input::cleaner($_POST['account_type']),
                "username"      => Input::seo($_POST['username']),
                "name"          => Input::cleaner($_POST['name']), 
                "email"         => Input::cleaner($_POST['email']), 
                "password"      => $Password, 
                "avatar"        => $Image,
                "banned"        => (int)Input::cleaner($_POST['banned'],0),
                "chatboxban"    => (int)Input::seo($_POST['chatboxban'],0),
                'data'          => json_encode($Settings['data'], JSON_UNESCAPED_UNICODE),
            );   
            $this->db->update('users')->where('id',$Listing['id'])->set($dataarray); 
 
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/users');
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
}
