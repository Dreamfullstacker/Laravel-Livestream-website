<?php
/**
 * 
 */
class Logout extends Controller {  
    public function process() {     
		setcookie('Auth', '', time() - (86400 * 530), "/");
		unset($_SESSION['facebook_access_token']);
		session_destroy();
		header('Location: '.APP);
    } 
}