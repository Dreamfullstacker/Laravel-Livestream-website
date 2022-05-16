<?php 
error_reporting(1);
// Default timezone
date_default_timezone_set("UTC"); 

// Defaullt multibyte encoding
mb_internal_encoding("UTF-8"); 

// ROOTPATH
define("ROOTPATH", dirname(__FILE__)."/..");

// Check if SSL enabled
$ssl = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off" 
? true : false;
define("SSL_ENABLED", $ssl);

// Define APPURL
$app_url = (SSL_ENABLED ? "https" : "http")
. "://"
. $_SERVER["SERVER_NAME"]
. (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
. trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

$p = strrpos($app_url, "/install");
if ($p !== false) {
$app_url = substr_replace($app_url, "", $p, strlen("/install"));
}

define("APP", $app_url);

require_once ROOTPATH."/install/app/core/Autoloader.php";

$loader = new Autoloader;
$loader->register();
$loader->addBaseDir(ROOTPATH.'/install/app/core');
$loader->addBaseDir(ROOTPATH.'/install/app/vendor');

if (Input::cleaner($_POST['_ACTION']) == "install") {

// Check database connection
$dsn = 'mysql:host=' 
. Input::cleaner($_POST['db_host']) 
. ';dbname=' . Input::cleaner($_POST['db_name'])
. ';charset=utf8';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
$connection = new PDO($dsn, Input::cleaner($_POST['db_username']), Input::cleaner($_POST['db_password']), $options);
} catch (\Exception $e) {
$Notify = "Couldn't connect to the database!";
}
if(!$Notify) {

$dbconfig_file_path = "../app/config/db.config.php";
$sql_file_path = "inc/db.sql";

$dbconfig = file_get_contents($dbconfig_file_path);
$dbconfig = str_replace(
["W_HOST", "W_NAME", "W_USER", "W_PASS"],
[
Input::cleaner($_POST['db_host']),
Input::cleaner($_POST['db_name']),
Input::cleaner($_POST['db_username']),
Input::cleaner($_POST['db_password'])
],
$dbconfig
);
file_put_contents($dbconfig_file_path, $dbconfig); 

$SQL = file_get_contents($sql_file_path);
$sqlpost = $connection->prepare($SQL);
$sqlpost->execute();
header("Location: ".APP.'/install?step=success');
}
}
