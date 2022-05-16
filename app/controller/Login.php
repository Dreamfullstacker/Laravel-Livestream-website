<?php
defined('BASEPATH') or exit('No direct script access allowed'); 

class Login extends Controller
{
    public function process()
    { 
        $AuthUser               = $this->getVariable("AuthUser");
        $Route                  = $this->getVariable("Route");
        $Settings               = $this->getVariable("Settings");    
        $isValid                = $this->getVariable("isValid"); 
        if (Input::cleaner($_POST['_ACTION']) == 'login' AND $isValid) {
            $this->check(); 
        } elseif ($AuthUser['id']) {
            header("location: " . APP);
        }

        $Config['title']        = __('Login').' - '.get($Settings, "data.title", "general");
        $Config['description']  = get($Settings, "data.description", "general"); 
        $Config['url']          = APP.'/login'; 
        $this->setVariable("Config", $Config);  
        $this->view('login', 'app');
    }

    public function check()
    {

        $Email = Input::cleaner($_POST['email']);
        $Password = Input::cleaner($_POST['password']);
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $Notify['type'] = 'warning';
            $Notify['text'] = __('Error');
        }
        if (!$Email || !$Password) {
            $Notify['type'] = 'warning';
            $Notify['text'] = __('Fill in all fields');
        }

        if (empty($Notify)) {
            $Login = $this->db->from('users')->where('email', $Email)->where('password', Input::cryptor($Password), '=', 'AND')->first();
            if($Login['banned'] == 1) {
                $Notify['type'] = 'danger';
                $Notify['text'] = __('Your account has been banned !');
                $this->notify($Notify);

            } elseif (($Email == $Login['email']) and (Input::cryptor($Password) == $Login['password'])) {
                $AuthToken      = Input::cryptor($Login['email'] . $Login['password'] . $Login['id']);
                setcookie('Auth', $AuthToken, time() + (86400 * 365), "/");

                $this->db->update('users')->where('id', $Login['id'], '=')->set(array('token' => $AuthToken));
                header("location: " . APP);
            } else {
                $Notify['type'] = 'danger';
                $Notify['text'] = __('Your information is incorrect !');
                $this->notify($Notify);
            }
        } else {
            $this->notify($Notify);
        }
        return $this;
    }
}
