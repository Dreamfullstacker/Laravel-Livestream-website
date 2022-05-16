<!DOCTYPE html>
<html class="app">

<head>
    <title>
        <?php echo __('Dashboard');?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS.'/css/app.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style type="text/css">
    :root {
        --theme-color: <?php echo get($Settings, "data.dashboard", "theme")?>;
    }
    </style>
    <script type="text/javascript">
    var URL = "<?php echo APP?>";
    var ASSETS = "<?php echo APP.'/public/assets'?>";

    window.i18n = {
        'Deletion is successful': '<?php echo __("Deletion is successful");?>'
    };
    </script>
    <meta name="theme-color" content="#000">
    <link rel="shortcut icon" href="<?php echo LOCAL.'/'.get($Settings,'data.favicon','general').'?v='.VERSION;?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
