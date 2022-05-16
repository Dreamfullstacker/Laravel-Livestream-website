<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MatthiasMullie\Minify;
class Settings extends Controller {
	public function process() {
		$AuthUser = $this->getVariable("AuthUser");
		$Route = $this->getVariable("Route");
		$Config['title'] = TITLE;
		$Config['description'] = DESC;
		$Config['nav'] = 'settings';

        $Languages      = $this->db->from('languages')->orderby('name','ASC')->all();
		$HomeModules    = $this->db->from('modules')->where('page','home')->orderby('sortable','ASC')->all();
        $TabNav = array(
            'general'   =>  __('General'),
            'social'    =>  __('Social Media'),
            'block'     =>  __('Blocks'),
            'theme'     =>  __('Theme'),
            'seo'       =>  __('Seo'),
            'email'     =>  __('Email'),
            'api'       =>  __('Api')
        ); 
		$this->setVariable("Config", $Config);
		$this->setVariable("HomeModules", $HomeModules);
        $this->setVariable("Languages", $Languages);
		$this->setVariable("TabNav", $TabNav);
		if(Input::cleaner($_POST['_ACTION']) == 'save') {
            $this->save();
        } 
		$this->view('settings', 'admin');
	}

    public function save() { 
        $SettingsData              = $this->getVariable("Settings");
        if (empty($Notify)) { 
            /*
            require PATH . '/config/array.config.php';
            // app.min.js
            foreach ($Jquery as $key) {
                $js .= file_get_contents($key);
            }
            $minifiedCode = \JShrink\Minifier::minify($js, array('flaggedComments' => false));

            $minifiedFile = fopen(PATH . '/theme/assets/js/app.min.js',"w+");
            fwrite($minifiedFile,$minifiedCode);
            fclose($minifiedFile);
            $js = null;
            // detail.min.js
            foreach ($JqueryDetail as $key) {
                $js .= file_get_contents($key);
            }
            $minifiedCode = \JShrink\Minifier::minify($js, array('flaggedComments' => false));

            $minifiedFile = fopen(PATH . '/theme/assets/js/detail.min.js',"w+");
            fwrite($minifiedFile,$minifiedCode);
            fclose($minifiedFile);
            $js = null;
            // player.min.js
            foreach ($JqueryPlayer as $key) {
                $js .= file_get_contents($key);
            }
            $minifiedCode = \JShrink\Minifier::minify($js, array('flaggedComments' => false));

            $minifiedFile = fopen(PATH . '/theme/assets/js/player.min.js',"w+");
            fwrite($minifiedFile,$minifiedCode);
            fclose($minifiedFile);
            $js = null;

            $minifier = new Minify\JS(PATH . '/theme/assets/js/app.min.js');
            $minifier->minify(PATH . '/theme/assets/js/app.min.js',0);
            */
            foreach ($_POST['data'] as $key => $value) { 
                if($value) { 
                    if($key == 'footer_text') {
                        $Settings['data'][$key] = htmlspecialchars(Input::cleaner($value));
                    }else{
                        $Settings['data'][$key] = $value;
                    }
                }
            } 
            $foo = new \Verot\Upload\Upload($_FILES['logo']);
            if ($foo->uploaded) {

                unlink(ROOTPATH.'/public/static/'.get($SettingsData,'data.logo','general'));
                $foo->allowed               = array('image/*');
                $foo->file_auto_rename      = true;
                $foo->file_new_name_body    = 'logo';
                $foo->jpeg_quality          = 100;
                $foo->Process(ROOTPATH.'/public/static/');
                if ($foo->processed) {
                    $Settings['data']['general']['logo'] = $foo->file_dst_name;
                }
            }else{
                $Settings['data']['general']['logo'] = get($SettingsData,'data.logo','general');
            }

            $Favicon = new \Verot\Upload\Upload($_FILES['favicon']);
            if ($Favicon->uploaded) {

                unlink(ROOTPATH.'/public/static/'.get($SettingsData,'data.favicon','general'));
                $Favicon->allowed               = array('image/*');
                $Favicon->file_auto_rename      = true;
                $Favicon->file_new_name_body    = 'favicon';
                $Favicon->jpeg_quality          = 100;
                $Favicon->Process(ROOTPATH.'/public/static/');
                if ($Favicon->processed) {
                    $Settings['data']['general']['favicon'] = $Favicon->file_dst_name;
                }
            }else{
                $Settings['data']['general']['favicon'] = get($SettingsData,'data.favicon','general');
            }
  
            foreach ($Settings['data'] as $key => $value) {  
                $Setting   = $this->db->from('settings')->where('name',$key)->first();
                if($Setting['id']) {
                    $dataarray          = array(
                        "name"          => Input::cleaner($key),
                        "data"          => json_encode($Settings['data'][$key],JSON_UNESCAPED_UNICODE)
                    );
                    $this->db->update('settings')->where('name',$key)->set($dataarray);  
                } elseif(!$Setting['id']) {
                    $dataarray          = array(
                        "name"          => Input::cleaner($key),
                        "data"          => json_encode($Settings['data'][$key],JSON_UNESCAPED_UNICODE)
                    );
                    $this->db->insert('settings')->set($dataarray);  
                }
            }
            foreach ($_POST['module'] as $Module) {  
                $dataarray          = array(
                    "name"          => Input::cleaner($Module['name']),
                    "data"          => json_encode($Module['data'],JSON_UNESCAPED_UNICODE),
                    "data_limit"    => Input::cleaner($Module['data_limit'],0),
                    "sortable"       => Input::cleaner($Module['sortable']),
                    "status"        => Input::cleaner($Module['status'],2)
                );
                $this->db->update('modules')->where('id',$Module['id'])->set($dataarray);  
            }
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/settings'); 
        }else{ 
            $this->notify($Notify);
        }
        return $this;
    }
}
