<?php
include '../app/config/db.config.php';
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];

$profile = 'https://' . $_SERVER['SERVER_NAME'] . '/profile/' . $_SESSION['username'];
	

if($_SESSION['type'] == 'admin') {
	$text_message = "<div class='msgln' style='padding:5px;border-bottom:0.1px solid #1b1b1b;border-radius:5px;'><span class='chat-time'>".date("g:i A")."</span> <a href=" . $profile . "><b class='user-name' style='color:red;'>".$_SESSION['name']."</b></a>: ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("../chatlogs/chatlog.html", $text_message, FILE_APPEND | LOCK_EX);
 } else {
	$text_message = "<div class='msgln' style='padding:5px;border-bottom:0.1px solid #1b1b1b;border-radius:5px;'><span class='chat-time'>".date("g:i A")."</span> <a href=" . $profile . "><b class='user-name' style='color: var(--theme-color);'>".$_SESSION['name']."</b></a>: ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("../chatlogs/chatlog.html", $text_message, FILE_APPEND | LOCK_EX);
 }
 }
?>
