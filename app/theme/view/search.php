<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item active"><a href="<?php echo APP.'/search/'.$Route->params->q;?>"><?php echo __('Search Results');?></a></li>
</ol>
</nav>
<?php echo ads($Ads,3,'mb-3');?>
<div class="filter-btn" data-toggle="modal" data-target="#filter"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#filter';?>" /></svg></div>
<div class="d-flex">
<div class="app-content">
<div class="app-section">
<div class="mb-4">
<div class="text-24 text-white font-weight-bold"><?php echo __('Search Results');?></div>
<div class="subtext text-12">"<?php echo urldecode($Route->params->q);?>" <?php echo __('verbal');?> <?php echo count($Movies)+count($Series)+count($Actors);?> <?php echo __('result found');?></div>
<div class="nav-active-border text-12 b-primary bottom mt-3">
<ul class="nav pt-0" id="myTab" role="tablist">
<li><a class="nav-link active" id="movies-tab" data-toggle="tab" href="#movies" role="tab" aria-controls="movies" aria-selected="true"><?php echo __('Movies');?></a></li>
<li><a class="nav-link" id="series-tab" data-toggle="tab" href="#series" role="tab" aria-controls="series" aria-selected="false"><?php echo __('Series');?></a></li>
<li><a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors" role="tab" aria-controls="actors" aria-selected="false"><?php echo __('Actors');?></a></li>
</ul>
</div>
</div>
<div class="tab-content">
<!-- movies -->
<div class="tab-pane active" id="movies" role="tabpanel" aria-labelledby="movies-tab">
<div class="row row-cols-5">
<?php foreach ($Movies as $Movie) {?>
<div class="col">
<div class="list-movie">
<a href="<?php echo post($Movie['id'],$Movie['title'],$Movie['type']);?>" class="list-media">
<?php if($Movie['quality']) { ?>
<div class="list-media-attr">
<div class="quality"><?php echo $Movie['quality'];?></div>
</div>
<?php } ?>
<div class="play-btn"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" /></svg></div>
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Movie['image'];?>"></div>
</a>
<div class="list-caption">
<a href="<?php echo post($Movie['id'],$Movie['title'],$Movie['type']);?>" class="list-title"><?php echo $Movie['title'];?></a>
<a href="<?php echo post($Movie['id'],$Movie['title'],$Movie['type']);?>" class="list-category"><?php echo $Movie['name'];?></a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<!-- movies -->
<!-- series -->
<div class="tab-pane" id="series" role="tabpanel" aria-labelledby="series-tab">
<div class="row row-cols-5">
<?php foreach ($Series as $Serie) {?>
<div class="col">
<div class="list-movie">
<a href="<?php echo post($Serie['id'],$Serie['title'],$Serie['type']);?>" class="list-media">
<?php if($Serie['quality']) { ?>
<div class="list-media-attr">
<div class="quality"><?php echo $Serie['quality'];?></div>
</div>
<?php } ?>
<div class="play-btn"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" /></svg></div>
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Serie['image'];?>"></div>
</a>
<div class="list-caption">
<a href="<?php echo post($Serie['id'],$Serie['title'],$Serie['type']);?>" class="list-title"><?php echo $Serie['title'];?></a>
<a href="<?php echo post($Serie['id'],$Serie['title'],$Serie['type']);?>" class="list-category"><?php echo $Serie['name'];?></a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<!-- series -->
<!-- actors -->
<div class="tab-pane" id="actors" role="tabpanel" aria-labelledby="actors-tab">
<div class="row row-cols-5">
<?php foreach ($Actors as $Actor) {?>
<div class="col">
<div class="list-actor">
<a href="<?php echo actor($Actor['id'],$Actor['name']);?>" class="list-media" title="<?php echo $Actor['name'];?>">
<div class="media" data-src="<?php echo UPLOAD.'/actor/'.$Actor['image'];?>"></div>
</a>
<div class="list-caption">
<a href="<?php echo actor($Actor['id'],$Actor['name']);?>" class="list-title" title="<?php echo $Actor['name'];?>">
<?php echo $Actor['name'];?></a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<!-- actors -->
</div>
</div>
</div>
</div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
