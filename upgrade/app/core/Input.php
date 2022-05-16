<?php
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
return $data;
}
}
public function seo($url = null)
{
$url = trim($url);
$find = array(
'<b>',
'</b>',
);
$url = str_replace($find, '', $url);
$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
$find = array(
' ',
'&amp;amp;amp;quot;',
'&amp;amp;amp;amp;',
'&amp;amp;amp;',
'\r\n',
'\n',
'/',
'\\',
'+',
'<',
'>',
);
$url = str_replace($find, '-', $url);
$find = array(
'é',
'è',
'ë',
'ê',
'É',
'È',
'Ë',
'Ê',
);
$url = str_replace($find, 'e', $url);
$find = array(
'í',
'ý',
'ì',
'î',
'ï',
'I',
'Ý',
'Í',
'Ì',
'Î',
'Ï',
'İ',
'ı',
);
$url = str_replace($find, 'i', $url);
$find = array(
'ó',
'ö',
'Ö',
'ò',
'ô',
'Ó',
'Ò',
'Ô',
);
$url = str_replace($find, 'o', $url);
$find = array(
'á',
'ä',
'â',
'à',
'â',
'Ä',
'Â',
'Á',
'À',
'Â',
);
$url = str_replace($find, 'a', $url);
$find = array(
'ú',
'ü',
'Ü',
'ù',
'û',
'Ú',
'Ù',
'Û',
);
$url = str_replace($find, 'u', $url);
$find = array(
'ç',
'Ç',
);
$url = str_replace($find, 'c', $url);
$find = array(
'þ',
'Þ',
'ş',
'Ş',
);
$url = str_replace($find, 's', $url);
$find = array(
'ð',
'Ð',
'ğ',
'Ğ',
);
$url = str_replace($find, 'g', $url);
$find = array(
'.',
',',
);
$url = str_replace($find, '-', $url);
$find = array(
'/[^A-Za-z0-9\-<>]/',
'/[\-]+/',
'/<&#91;^>]*>/',
);
$repl = array(
'',
'-',
'',
);
$url = preg_replace($find, $repl, $url);
$url = str_replace('--', '-', $url);
$url = strtolower($url);
$url = rtrim($url, '-');
return $url;
}

public function cryptor($password = null)
{
return md5(sha1(md5(sha1($password))));
}

function hasher($action, $string = null) {
$output = false;
$encrypt_method = "AES-256-CBC";
$secret_key = 'SCRPTJ-'.KEY;
$secret_iv  = 'SCRPTJ-546128';
$key= hash('sha256', $secret_key);
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
