<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class Recovery extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
        $Settings               = $this->getVariable("Settings");    
        $isValid                = $this->getVariable("isValid"); 
 
		$Config['title'] 		= __('Forgot password').' - '.get($Settings, "data.title", "general");
		$Config['description'] 	= get($Settings, "data.description", "general");
		$Config['nav'] 			= 'main'; 

        if(Input::cleaner($_POST['email'])) {
            $User = $this->db->from('users')->where('email',Input::cleaner($_POST['email']))->first();
        }
        if(Input::cleaner($_POST['_ACTION']) == 'recovery' AND $isValid) { 
           $mail = new PHPMailer;
 
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = get($Settings,'data.host','email');  
            $mail->SMTPAuth   = true;    
            $mail->Username   = get($Settings,'data.username','email');
            $mail->Password   = get($Settings,'data.password','email');
            $mail->SMTPSecure = get($Settings,'data.security','email');
            $mail->Port       = get($Settings,'data.port','email');
            $mail->CharSet    = 'UTF-8'; 
            $mail->setFrom(Input::cleaner($_POST['email']), Input::cleaner($_POST['name']));
            if(get($Settings,'data.sendemail','email')) {
                $mail->addAddress(get($Settings,'data.sendemail','email'), __('Recovery'));
            }else{
                $mail->addAddress(get($Settings,'data.username','email'), __('Recovery'));     
            }
            $mail->addReplyTo(Input::cleaner($_POST['email']), Input::cleaner($_POST['name']));
             
 
            $mail->isHTML(true);                     
            $mail->Subject = __('Forgot password');

            $emailHtml .= '<h1>'.__('Forgot password').'</h1>';
            $emailHtml .= '<p>Password reset link has been established.You have requested the e-mail I forgot my password. The link below is for you to reset your password. By clicking the link, you can reset your password.</p>'; 
            $emailHtml .= '<a href="'.APP.'/recovery/'.Input::hasher('encode',$User['email']).'" class="btn">'.__('Reset my password').'</a>';  

            require_once PATH."/helper/email.temp.php"; 
            $mail->msgHTML(emailTemp($emailHtml,$Settings)); 

            $mail->send(); 

            $Notify['type'] = 'success';
            $Notify['text'] = __('Your password has been sent to your e-mail address !');
            $this->notify($Notify);
            header("location: " . APP."/login");
             
        } elseif($_POST['email'] AND !$User['id']) {
            $Notify['type'] = 'danger';
            $Notify['text'] = __('There is no such account');
            $this->notify($Notify);

        }
        $Config['url']          = APP.'/forgot-password'; 

		$this->setVariable("Config", $Config);
		$this->view('recovery', 'app');
	}
}