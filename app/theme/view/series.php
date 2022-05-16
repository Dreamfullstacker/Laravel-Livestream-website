<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item active"><a href="<?php echo APP.'/cursos';?>"><?php echo __('Series');?></a></li>
</ol>
</nav>
<?php echo ads($Ads,3,'mb-3');?>
<div class="filter-btn" data-toggle="modal" data-target="#filter"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#filter';?>" /></svg></div>
<div class="d-flex">
<div class="app-content">
<div class="app-section">
<div class="mb-3">
<div class="text-24 text-white font-weight-bold"><?php echo $Config['header'];?></div>
<div class="subtext text-12"><?php echo $Config['description'];?></div>
</div>
<?php require PATH . '/theme/view/common/filter.header.php';?>
<div class="row row-cols-md-5 row-cols-2">
<?php foreach ($Listings as $Listing) {?>
<div class="col">
<div class="list-movie">
<a href="<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>" class="list-media">
<?php if($Listing['quality'] || $Listing['imdb']) { ?>
<div class="list-media-attr">
<?php if($Listing['quality']) { ?>
<div class="quality"><?php echo $Listing['quality'];?></div>
<?php } ?>
<?php if($Listing['imdb']) { ?>
<div class="imdb">
<span>
<?php echo $Listing['imdb'];?></span>
<svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36"><circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Listing['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle></svg>
</div>
<?php } ?>
</div>
<?php } ?>
<div class="play-btn"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" /></svg></div>
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/'.$Listing['image'];?>">
<?php if($Listing['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Listing['mpaa'];?></div><?php } ?>
</div>
</a>
<div class="list-caption">
<a href="<?php echo post($Listing['id'],$Listing['title'],$Listing['type']);?>" class="list-title">
<?php echo $Listing['title'];?>
</a>
<?php if(empty($Listing['end_year'])) { ?><div class="list-year"><?php echo $Listing['create_year'];?></div><?php } ?><?php if(!empty($Listing['end_year'])) { ?><div class="list-year"><?php echo $Listing['create_year'];?> - <?php echo $Listing['end_year'];?></div><?php } ?>
</div>
</div>
</div>
<?php } ?>
</div>
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
