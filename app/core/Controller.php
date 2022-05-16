<?php
/**
 * @author  Scriptoji
 * @link    https://scriptoji.com
 * @since   Version 1.0.0
 */

class Controller {
    protected $variables;
    
    protected $resp;
    public $db; 
    
    public function __construct($variables = array()) {
        $this->variables        = array();
        $this->db               = new Database();    
        
    }
    
    public function view($view, $context, $data = array()) {
        foreach ($this->variables as $key => $value) {
            ${$key} = $value;
        }
        $Permissions = array(
            'Login',
            'Register',
            'Logout'
        );
        switch ($context) {
            case "admin":
                if (($AuthUser['id'] AND \Delight\Cookie\Cookie::exists('Auth') AND \Delight\Cookie\Cookie::get('Auth') == $AuthUser['token'] AND $AuthUser['account_type'] == 'admin') || in_array($Route->target[1], $Permissions)) {
                    $path = PATH . "/view/" . $view . ".php";
                }else{
                    header('location:'.APP.'/login');
                }
                break;
            
            case "app":  
                $path = PATH . "/theme/view/" . $view . ".php";
                break;
            
            case "ajax":
                $path = PATH . '/view/ajax/' . $view . '.php';
                break;
                
            case "modal":
                $path = PATH . '/view/modal/' . $view . '.php';
                break;
            
            default:
                $path = $view;
        }
        require_once $path;
    } 
    public function setVariable($name, $value) {
        $this->variables[$name] = $value;
        return $this;
    }
    
    public function getVariable($name) {
        return isset($this->variables[$name]) ? $this->variables[$name] : null;
    }
    protected function jsonecho($resp = null) {
        if (is_null($resp)) {
            $resp = $this->resp;
        }
        echo json_encode($resp);
        exit;
    }
    
    public function notify($data = array()) {
        if(count($data)>1) { 
            $_SESSION['notify']['display']      = 'hidden';
            $_SESSION['notify']['text']         = $data['text'];
            $_SESSION['notify']['type']         = $data['type'];
        }
    }

    public function __destruct() {  
    }
}