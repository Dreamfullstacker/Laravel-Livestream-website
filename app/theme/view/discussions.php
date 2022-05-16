<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo __('Discussions');?></li>
</ol>
</nav>
<?php echo ads($Ads,3,'mb-3');?>
<div class="app-section">
<div class="mb-3">
<div class="text-24 text-white font-weight-bold"><?php echo __('Discussions');?></div>
<div class="subtext"><?php echo __('You can open and discuss TV Series, Movies or General topics.');?></div>
</div>
<div class="row">
<div class="col">
<div class="d-flex align-items-center forum-filter">
<?php if($AuthUser['id']) { ?>
<button type="button" class="btn btn-sm btn-theme" data-toggle="modal" data-target="#m" data-remote="<?php echo APP.'/modal/discussion';?>"><?php echo __('Open thread');?></button>
<?php } ?>
</div>
<?php foreach ($Listings as $Listing) { ?>
<div class="list-forum">
<a href="<?php echo profile($Listing['user_id'],$Listing['username']);?>" class="list-avatar">
<?php echo gravatar($Listing['id'],$Listing['avatar'],$Listing['name'],'avatar');?>
</a>
<div class="flex-fill">
<div class="list-footer">
<a href="<?php echo profile($Listing['user_id'],$Listing['username']);?>" class="user">
<?php echo $Listing['username'];?></a>, 
<?php echo timeago($Listing['created']);?>
</div>
<a href="<?php echo discussion($Listing['id'],$Listing['title']);?>">
<div class="name"><?php echo $Listing['title'];?></div>
<div class="desc"><?php echo wordlimit($Listing['body']);?></div>
</a>
</div>
<div class="list-forum-comment">
<span class="count"><?php echo $Listing['replies'];?></span>
<span class="text"><?php echo __('Reply');?></span>
</div>
</div>
<?php } ?>
<?php echo $Pagination;?>
<div class="text-muted text-12">
<?php if($TotalRecord == 0) { ?>
<?php echo __('No content found');?>
<?php } else { ?>
<?php echo $TotalRecord;?> 
<?php echo __('contains content');?>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
