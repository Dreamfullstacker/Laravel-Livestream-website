<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item"><a href="<?php echo APP.'/discussions';?>"><?php echo __('Discussions');?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo wordlimit($Listing['title'],40);?></li>
</ol>
</nav>
<?php echo ads($Ads,3,'mb-3');?>
<div class="forum-detail">
<a href="<?php echo profile($Listing['user_id'],$Listing['username']);?>" class="forum-avatar">
<?php echo gravatar($Listing['id'],$Listing['avatar'],$Listing['name'],'avatar');?>
<svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36"><circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="100 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle></svg>
</a>
<div class="forum-content">
<h1><?php echo $Listing['title'];?></h1>
<div class="forum-footer">
<a href="<?php echo profile($Listing['user_id'],$Listing['username']);?>" class="user">
<?php echo $Listing['username'];?></a>, 
<?php echo timeago($Listing['created']);?>
</div>
<p><?php echo $Listing['body'];?></p>
<?php if($Listing['content_id']) { ?>
<div class="forum-post">
<div class="head"><?php echo __('Related Content');?></div>
<a href="<?php echo post($Listing['content_id'],$Listing['title'],$Listing['type']);?>" class="post-content">
<div class="cover">
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Listing['image'];?>"></div>
</div>
<div class="flex-fill">
<div class="name"><?php echo $Listing['post_title'];?></div>
<div class="category"><?php echo $Listing['category_name'];?></div>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
<?php require PATH . '/theme/view/common/comments.php';?>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
