<!DOCTYPE html>
<html lang="<?php echo ACTIVE_LANG;?>">

<head>
  
<meta charset="UTF-8">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<script src="https://hCaptcha.com/1/api.js" async></script>
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></noscript>
<script>
$(document).ready(function() {
    // This will fire when document is ready:
    $(window).resize(function() {
        // This will fire each time the window is resized:
        if($(window).width() >= 1024) {
            // if larger or equal
            $('.element').show();
        } else {
            // if smaller
   $(window).scroll(function() {

    if ($(this).scrollTop()>0)
     {
        $('.fadein_out').fadeOut();
     }
    else
     {
      $('.fadein_out').fadeIn();
     }
 });
        }
    }).resize(); // This will simulate a resize to trigger the initial run.
});
</script>

	<?php if(get($Settings,'data.scrollablehome','theme') == 1) { } else { ?>

	<?php } ?>
 	<?php if(get($Settings,'data.slidingmenu','theme') == 1) { ?>
	<script>
		$(function() { 
 			var contentToggle = 0; 
				$('.app-navbar').on('click', function() { 
					if (contentToggle == 0) { 
						$('.app-container').animate({
        					width:'80%'
						})  
						contentToggle = 1; 
					}
					else if (contentToggle == 1) {
						$('.app-container').animate({
        					width:'100%'
						}) 
					contentToggle = 0; 
					}
				}) 
			})
		$(function() { 
 			var contentToggle = 0; 
				$('.app-navbar').on('click', function() { 
					if (contentToggle == 0) { 
						$('.hide-me').animate({
        					width:'20%'
						})  
						contentToggle = 1; 
					}
					else if (contentToggle == 1) {
						$('.hide-me').animate({
       	 					width:'0%'
						}) 
						contentToggle = 0; 
					}
				}) 
			})
	</script>
	<?php }; ?>
	<link rel="manifest" href="<?php echo APP;?>/manifest.json">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $Config['description'];?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow" />
    <meta name="theme-color" content="#000">
    <meta name="HandheldFriendly" content="True">
    <meta http-equiv="cleartype" content="on">
    <?php if($Config['url']) { ?>
    <link rel="canonical" href="<?php echo $Config['url'];?>">
    <?php } ?>
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="dns-prefetch" href="//ajax.googleapis.com" />
    <link rel="dns-prefetch" href="//www.googletagmanager.com" />
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link rel="dns-prefetch" href="//code.jquery.com" />
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />
    <link rel="dns-prefetch" href="//www.google-analytics.com">
<?php if (empty(get($Settings,'data.darktheme','theme'))) { ?>
<link as="style" media="all" rel="stylesheet preload prefetch" href="<?php echo THEME.'/css/app.css';?>" type="text/css" crossorigin="anonymous" />
<?php } ?>
<?php if(get($Settings,'data.darktheme','theme') == 1) { ?>
<link as="style" media="all" rel="stylesheet preload prefetch" href="<?php echo THEME.'/css/app.css';?>" type="text/css" crossorigin="anonymous" />
<?php } ?>
<?php if(get($Settings,'data.lighttheme','theme') == 1) { ?>
<link as="style" media="all" rel="stylesheet preload prefetch" href="<?php echo THEME.'/css/light.css';?>" type="text/css" crossorigin="anonymous" />
<?php } ?>
<?php if(get($Settings,'data.purpletheme','theme') == 1) { ?>
<link as="style" media="all" rel="stylesheet preload prefetch" href="<?php echo THEME.'/css/purple.css';?>" type="text/css" crossorigin="anonymous" />
<?php } ?>
    <link rel="preload" href="<?php echo ASSETS.'/webfonts/inter/Inter-Regular.woff2';?>" as="font" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo ASSETS.'/webfonts/inter/Inter-Medium.woff2';?>" as="font" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo ASSETS.'/webfonts/inter/Inter-SemiBold.woff2';?>" as="font" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo ASSETS.'/webfonts/inter/Inter-Bold.woff2';?>" as="font" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo ASSETS.'/webfonts/inter/Inter-Black.woff2';?>" as="font" crossorigin="anonymous" />
    <script type="text/javascript">
        var _URL = "<?= APP?>";
        var _ASSETS = "<?= APP.'/public/assets'?>";
        <?php if ($AuthUser['id']) { ?>
        var _Auth = true;
        <?php } else { ?>
        var _Auth = false;
        <?php } ?>
        var __ = function(msgid) {
            return window.i18n[msgid] || msgid;
        };
        window.i18n = {
            'No comments yet': '<?php echo __("No comments yet");?>',
            'You must sign in': '<?php echo __("You must sign in");?>',
            'Follow': '<?php echo __("Follow");?>',
            'Following': '<?php echo __("Following");?>',
            'Show more': '<?php echo __("Show more");?>',
            'Show less': '<?php echo __("Show less");?>',
            'no results': '<?php echo __("no results");?>',
            'Results': '<?php echo __("Results");?>',
            'Comment': '<?php echo __("Comment");?>',
            'Actors': '<?php echo __("Actors");?>',
        };
        <?php if(get($Settings,'data.onesignal_id','api')) { ?>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
            appId: '<?php echo get($Settings,"data.onesignal_id","api");?>',
            autoRegister: true
        }]);
        var OneSignal = window.OneSignal || [];
        if (OneSignal.installServiceWorker) {
            OneSignal.installServiceWorker();
        } else {
            if (navigator.serviceWorker) {
                navigator.serviceWorker.register('<?php echo APP."/OneSignalSDKWorker.js?appId=".get($Settings,"data.onesignal_id","api");?>');
            }
        }
        <?php } ?>
    </script>
    <style type="text/css">
    :root {
        --theme-color: <?php echo ($_COOKIE['--theme-color'] ? $_COOKIE['--theme-color']: get($Settings, "data.general", "theme"));
        ?>;
        --button-color: <?php echo ($_COOKIE['--button-color'] ? $_COOKIE['--button-color']: get($Settings, "data.button", "theme"));
        ?>;
        --background-color: <?php echo ($_COOKIE['--background-color'] ? urldecode($_COOKIE['--background-color']): get($Settings, "data.background", "theme"));
        ?>;
    }
    </style>
    <?php echo get($Settings,'data.headcode','general');?>
    <?php if($Config['share'] == true) { ?>
    <meta property="og:site_name" content="<?php echo APP;?>">
    <meta property="og:url" content="<?php echo $Config['url'];?>">
    <meta property="og:type" content="<?php echo $Config['ogtype'];?>">
    <meta property="og:title" content="<?php echo $Config['title'];?>">
    <meta property="og:description" content="<?php echo $Config['description'];?>">
    <?php if($Config['image']) { ?>
    <meta property="og:image" content="<?php echo $Config['image'];?>">
    <?php } ?>
    <meta name="twitter:card" content="summary">
    <?php if(get($Settings, "data.twitter", "social")) { ?>
    <meta name="twitter:site" content="@<?php echo get($Settings, " data.twitter", "social" );?>">
    <?php } ?>
    <meta name="twitter:title" content="<?php echo $Config['title'];?>">
    <meta name="twitter:url" content="<?php echo $Config['url'];?>">
    <meta name="twitter:description" content="<?php echo $Config['description'];?>">
    <?php if($Config['image']) { ?>
    <meta name="twitter:image" content="<?php echo $Config['image'];?>" />
    <?php } ?>
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo LOCAL.'/'.get($Settings,'data.favicon','general').'?v='.VERSION;?>">
		<script type="application/ld+json">    
		{
  			"@context": "https://schema.org",
  			"@type": "WebSite",
  			"url": "<?php echo APP;?>",
  			"potentialAction": {
    			"@type": "SearchAction",
    			"target": "<?php echo APP;?>/search/{search_term_string}",
    			"query-input": "required name=search_term_string"
  			}
		}
 </script>
    <title>
        <?php echo $Config['title'];?>
    </title>
</head>

<body>

<style>
#menu {
	background: #000000;
	color: #FFF;
	height: 29px;
	padding-left: 18px;
	border-radius: 6px;
}
#menu ul, #menu li {
	margin: 0 auto;
	padding: 0;
	list-style: none
}
#menu ul {
	width: 100%;
}
#menu li {
	float: left;
	display: inline;
	position: relative;
}
#menu a {
	display: block;
	line-height: 29px;
	padding: 0 14px;
	text-decoration: none;
	color: #FFFFFF;
	font-size: 16px;
	text-transform: capitalize;
}
#menu a.dropdown-arrow:after {
	content: "\25BE";
	margin-left: 5px;
}
#menu li a:hover {
	color: #FF1212;
	background: #000000;
}
#menu input {
	display: none;
	margin: 0;
	padding: 0;
	height: 29px;
	width: 100%;
	opacity: 0;
	cursor: pointer
}
#menu label {
	display: none;
	line-height: 29px;
	text-align: center;
	position: absolute;
	left: 35px
}
#menu label:before {
	font-size: 1.6em;
	content: "\2261"; 
	margin-left: 20px;
}
#menu ul.sub-menus{
	height: auto;
	overflow: hidden;
	width: 170px;
	background: #000000;
	position: absolute;
	z-index: 99;
	display: none;
}
#menu ul.sub-menus li {
	display: block;
	width: 100%;
}
#menu ul.sub-menus a {
	color: #FFFFFF;
	font-size: 16px;
}
#menu li:hover ul.sub-menus {
	display: block
}
#menu ul.sub-menus a:hover{
	background: #000000;
	color: #FF0000;
}
@media screen and (max-width: 800px){
	#menu {position:fixed;
	visibility:hidden; margin-top:0px}
	#menu ul {background:#111;position:absolute;top:100%;right:0;left:0;z-index:3;height:auto;display:none;
	visibility:hidden;}
	#menu ul.sub-menus {width:100%;position:static;
	visibility:hidden;}
	#menu ul.sub-menus a {padding-left:30px;
	visibility:hidden;}
	#menu li {display:block;float:none;width:auto;
	visibility:hidden;}
	#menu input, #menu label {position:absolute;top:0;left:0;display:block;
	visibility:hidden;}
	#menu input {z-index:4;
	visibility:hidden;}
	#menu input:checked + label {color:white;
	visibility:hidden;}
	#menu input:checked + label:before {content:"\00d7";
	visibility:hidden;}
	#menu input:checked ~ ul {display:block;
	visibility:hidden;}
}
</style>

    <a class="skip-link d-none" href="#maincontent">Skip</a>
    
