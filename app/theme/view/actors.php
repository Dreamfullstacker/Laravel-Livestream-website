<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo __('Actors');?></li>
</ol>
</nav>
<?php echo ads($Ads,3,'mb-3');?>
<div class="d-flex">
<div class="app-content">
<div class="app-section">
<div class="mb-3">
<div class="text-24 text-white font-weight-bold"><?php echo __('Actors');?></div>
</div>
<!-- movies -->
<div class="row row-cols-md-5 row-cols-2">
<?php foreach ($Listings as $Listing) { ?>
<div class="col">
<div class="list-actor">
<a href="<?php echo actor($Listing['id'],$Listing['name']);?>" class="list-media" title="<?php echo $Listing['name'];?>">
<div class="media" data-src="<?php echo UPLOAD.'/actor/'.$Listing['image'];?>"></div>
</a>
<div class="list-caption">
<a href="<?php echo actor($Listing['id'],$Listing['name']);?>" class="list-title" title="<?php echo $Listing['name'];?>"><?php echo $Listing['name'];?></a> 
</div>
</div>
</div>
<?php } ?>
</div>
<!-- movies -->
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
