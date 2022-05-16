<?php 
@session_start();
set_time_limit(0);

define("ENVIRONMENT", "production");

if (ENVIRONMENT == "development") {
error_reporting(1);
} else if (ENVIRONMENT == "production") {
error_reporting(0);
} else {
header('HTTP/1.1 503 Service Unavailable.', true, 503);
echo 'Environment is invalid. Please contact developer for more information.';
exit;
}

// Path to root directory of app.
define("ROOTPATH", dirname(__FILE__));

// Path to app folder.
define("PATH", ROOTPATH."/app");
define("UPLOADPATH", ROOTPATH."/public/upload");
define("CACHEPATH", ROOTPATH."/app/cache");

// Check if SSL enabled.
$ssl = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off" 
? true 
: false;
define("SSL_ENABLED", $ssl);

// URL of the application root. 
// This is not the URL of the app directory.
$app_url = "https://"
. $_SERVER["SERVER_NAME"]
. (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
. trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
define("APP", $app_url);
define("DOMAIN", $_SERVER["HTTP_HOST"]);

// Define Base Path (for routing)
$base_path = trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
$base_path = $base_path ? "/" . $base_path : "";
define("BASEPATH", $base_path);
define("DASHBOARD", $app_url.'/admin');
define("ASSETS", $app_url.'/public/assets');
define("THEME", $app_url.'/app/theme/assets');
define("UPLOAD", $app_url.'/public/upload'); 
define("LOCAL", $app_url.'/public/static');

// Required libraries, config files and helpers...
require_once PATH.'/autoload.php';
require_once PATH.'/config/config.php';
require_once PATH."/helper/helper.php";

// Run the app...
$App = new App;
$App->process();
?>
