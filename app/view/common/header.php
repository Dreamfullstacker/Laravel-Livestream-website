<?php require PATH . '/view/common/assets.php'; ?>
<div class="app-wrapper">
    <div class="app-aside nav-aside" id="aside">
        <button class="modal-close d-md-none d-block" data-dismiss="modal">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
            </svg>
        </button>
        <div class="app-navbar">
            <a href="<?php echo APP.'/admin';?>" class="navbar-brand ">
                <img src="<?php echo LOCAL.'/'.get($Settings,'data.favicon','general').'?v='.VERSION;?>" alt="<?php echo get($Settings,'data.title','general');?>" style="height:50px;width:auto;">
            </a>
            <a href="<?php echo APP;?>" target="_blank" class="frontend">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#house';?>" />
                </svg>
            </a>
        </div>
        <div class="nav-profile">
            <a href="<?php echo APP.'/admin/user/'.$AuthUser['id'];?>" class="d-flex align-items-center">
                <?php echo gravatar($AuthUser['id'],$AuthUser['avatar'],$AuthUser['name'],'avatar lazy');?>
                <div class="ml-3">
                    <div class="nav-type">Admin</div>
                    <div class="nav-name">
                        <?php echo $AuthUser['name'];?>
                    </div>
                </div>
            </a>
        </div>
        <ul class="nav" data-nav>
            <?php
                require_once PATH . '/config/menu.config.php';
                echo nav($DashboardNav, $Config['nav'], $Count);
                ?>
        </ul>
        <ul class="nav nav-footer" data-nav>
            <?php 
                echo nav($DashboardNav2, $Config['nav'], $Count);
                ?>
        </ul>
    </div>
    <div class="app-content">
        <div class="navbar navbar-expand-lg d-md-none d-flex">
            <div class="menu" data-toggle="modal" data-target="#aside">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#bars';?>" />
                </svg>
            </div>
            <div class="app-navbar mr-auto">
                <a href="<?php echo APP.'/admin';?>" class="navbar-brand">
                    <img src="<?php echo LOCAL.'/'.get($Settings,'data.favicon','general').'?v='.VERSION;?>" alt="<?php echo get($Settings,'data.title','general');?>" style="height:50px;width:auto;">
                </a>
            </div>
        </div>
