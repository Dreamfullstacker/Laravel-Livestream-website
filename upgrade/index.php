<?php require_once 'init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
<meta name="theme-color" content="#fff">
<link rel="icon" href="./assets/img/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="../public/assets/css/app.css?v=4.2">
<title>Upgrade Version</title> 
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-8 offset-md-2">
<?php 
if(!$_GET['step']) { 
require_once 'app/common/welcome.fragment.php';
} elseif($_GET['step'] == '2') {
require_once 'app/common/requirements.fragment.php';
} elseif($_GET['step'] == '3') {
require_once 'app/common/controls.fragment.php';
} elseif($_GET['step'] == 'success') {
require_once 'app/common/success.fragment.php'; 
}
?>
</div>
</div>
</div>
</body>
</html>
