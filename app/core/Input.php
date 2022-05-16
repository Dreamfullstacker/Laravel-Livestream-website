<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input
{

    public static function bind($event, callable $func)
    {
        if (empty(self::$callbacks[$event]) || !is_array(self::$callbacks[$event])) {
            self::$callbacks[$event] = [];
        }

        self::$callbacks[$event][] = $func;
    }

    /**
     * @return mixed
     */
    public static function trigger()
    {
        $args = func_get_args();
        $event = $args[0];
        unset($args[0]);

        if (isset(self::$callbacks[$event])) {
            foreach (self::$callbacks[$event] as $func) {
                call_user_func_array($func, $args);
            }
        }
    }

    public static function cleaner($data = null, $return = null)
    {
        $data = strip_tags($data);
        $get_data = $data;
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
 
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
 
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
 
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
 
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do
        {
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
            
        }
        while ($old_data !== $data); 
        // we are done...
        if ($data) {
            return $data;
        } elseif ($return) {
            return $return;
        } else {
            return NULL;
        } 
    }
    public function seo($string = ""){
        if (!is_string($string)) {
            $string = "";
        }

        $s = trim(mb_strtolower($string));
         
        $s = str_replace(
            array("ü", "ö", "ğ", "ı", "ə", "ç", "ş"), 
            array("u", "o", "g", "i", "e", "c", "s"), 
            $s);
         
        $cyr = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м',
                     'н','о','п','р','с','т','у', 'ф','х','ц','ч','ш','щ','ъ', 
                     'ы','ь', 'э', 'ю','я');
        $lat = array('a','b','v','g','d','e','io','zh','z','i','y','k','l',
                     'm','n','o','p','r','s','t','u', 'f', 'h', 'ts', 'ch',
                     'sh', 'sht', 'a', 'i', 'y', 'e','yu', 'ya');

        $s = str_replace($cyr, $lat, $s);
        $unicode_vn = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă", "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ", "ì","í","ị","ỉ","ĩ", "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ" ,"ờ","ớ","ợ","ở","ỡ", "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ", "ỳ","ý","ỵ","ỷ","ỹ", "đ", "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă" ,"Ằ","Ắ","Ặ","Ẳ","Ẵ", "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ", "Ì","Í","Ị","Ỉ","Ĩ", "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ" ,"Ờ","Ớ","Ợ","Ở","Ỡ", "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ", "Ỳ","Ý","Ỵ","Ỷ","Ỹ", "Đ");
        $unicode_vn_latin = array("a","a","a","a","a","a","a","a","a","a","a" ,"a","a","a","a","a","a", "e","e","e","e","e","e","e","e","e","e","e", "i","i","i","i","i", "o","o","o","o","o","o","o","o","o","o","o","o" ,"o","o","o","o","o", "u","u","u","u","u","u","u","u","u","u","u", "y","y","y","y","y", "d", "a","a","a","a","a","a","a","a","a","a","a","a" ,"a","a","a","a","a", "e","e","e","e","e","e","e","e","e","e","e", "i","i","i","i","i", "o","o","o","o","o","o","o","o","o","o","o","o" ,"o","o","o","o","o", "u","u","u","u","u","u","u","u","u","u","u", "y","y","y","y","y", "d");
        
        $s = str_replace($unicode_vn, $unicode_vn_latin, $s);
 
        $s = preg_replace("/[^a-z0-9]/", "-", $s);
 
        $s = preg_replace("/-{2,}/", "-", $s);

        return trim($s, "-");
    }


    public function cryptor($password = null)
    {
        return md5(sha1(md5(sha1($password))));
    }

    function hasher($action, $string = null) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key     = 'SCRPTJ-'.KEY;
        $secret_iv      = 'SCRPTJ-546128';
        $key            = hash('sha256', $secret_key);

        $iv = substr(hash('sha256', $secret_iv) , 0, 16);
        if ($action == 'encode') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if ($action == 'decode') {
            $output = openssl_decrypt(base64_decode($string) , $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
