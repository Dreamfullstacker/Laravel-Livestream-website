<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-detail flex-fill">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item"><a href="<?php echo APP.'/movies'?>"><?php echo __('Movies');?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo $Listing['title'];?></li>
</ol>
</nav>
<?php require PATH . '/theme/view/common/post.header.php';?>
<div class="detail-content">
<div class="cover">
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/'.$Listing['image'];?>"></div>
<?php if($Listing['trailer']) { ?>
<button type="button" class="btn btn-theme-lt mr-2 px-md-5 mb-2 trailer" data-toggle="modal" data-target="#lg" data-remote="<?php echo APP.'/modal/trailer?trailer='.urlencode($Listing['trailer']);?>">
<?php echo __('Trailer');?></button>
<?php } ?>
</div>
<div class="detail-text flex-fill">
<div class="caption">
<div class="caption-content">
<h1><?php echo $Listing['title'];?></h1>
<?php if($Listing['title_sub']) { ?><?php echo __('Also Known As');?>: <h2 style="display:inline;"><?php echo $Listing['title_sub'];?></h2><br /><?php } ?>
</div>
<?php if($Listing['description']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Overview');?></div>
<div class="text"><?php echo $Listing['description'];?></div>
</div>
<?php } ?>
<?php if($Listing['imdb']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('IMDB');?></div>
<div class="text"><?php echo $Listing['imdb'];?></div>
</div>
<?php } ?>
<?php if($Listing['country_name']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Country');?></div>
<div class="text">
<?php $self = str_replace(' ', '-', strtolower($Listing['country_name'])); ?>
<a href="<?php echo APP . '/country/' . $self; ?>"><?php echo $Listing['country_name'];?></a>
</div>
</div>
<?php } ?>
<div class="video-attr">
<div class="attr"><?php echo __('Genre');?></div>
<div class="text">
<?php foreach ($Categories as $Category) { ?>
<a href="<?php echo APP.'/movies/'.$Category['self'];?>">
<?php echo $Category['name'];?></a>
<?php } ?>
</div>
</div>
<?php if($Listing['mpaa']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('MPAA');?></div>
<div class="text"><?php echo $Listing['mpaa'];?></div>
</div>
<?php } ?>
<?php if($Listing['duration']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Duration');?></div>
<div class="text"><?php echo $Listing['duration'].' '.__('min');?></div>
</div>
<?php } ?>
<?php if($Listing['create_year']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Release Date');?></div>
<div class="text"><?php echo $Listing['create_year'];?></div>
</div>
<?php } ?>
<?php if(count($Actors) > 0) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Actors');?></div>
<div class="text" data-more="" data-element="a" data-limit="6">
<?php foreach ($Actors as $Actor) { ?>
<a href="<?php echo actor($Actor['actor_id'],$Actor['name']);?>">
<img src="<?php echo UPLOAD.'/actor/'.$Actor['image'];?>" width="200px" /><br />
<?php echo $Actor['name'];?>
<br /><?php echo $Actor['character_name'];?>
</a>
<?php } ?>
</div>
</div>
<?php } ?>
<div class="nav-social">
<?php foreach ($Data['social'] as $key => $value) { ?>
<?php if($value) { ?>
<a href="<?php echo 'https://www.'.$key.'.com/'.$value;?>" target="_blank" title="<?php echo $key;?>">
<svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$key;?>" /></svg>
</a>
<?php } ?>
<?php } ?>
</div>
<?php if($Data['tags']) { ?>
<div class="tags" data-more="" data-element="div" data-limit="6">
<?php 
$Tags = explode(',', $Data['tags']);
for ($i=0; $i <count($Tags); $i++) { 
?>
<div><?php echo $Tags[$i];?></div>
<?php } ?>
</div>
<?php } ?>
</div>
<div class="action">
<div class="video-view">
<div class="view-text">
<?php echo number_format($Listing['hit'], 0, ',', ',');?><span>
<?php echo __('views');?></span>
</div>
</div>
<div class="action-bar"><span style="width: <?php echo $Likes;?>%"></span></div>
<div class="action-btns">
<div class="action-btn like <?php if($Vote['reaction'] == 'up') echo 'active';?>" data-id="<?php echo $Listing['id'];?>">
<svg><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#like';?>" /></svg>
<span data-votes="<?php echo $Listing['likes'];?>"><?php echo $Listing['likes'];?></span>
</div>
<div class="action-btn dislike <?php if($Vote['reaction'] == 'down') echo 'active';?>" data-id="<?php echo $Listing['id'];?>">
<svg><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#dislike';?>" /></svg>
<span data-votes="<?php echo $Listing['dislikes'];?>"><?php echo $Listing['dislikes'];?></span>
</div>
</div>
</div>
</div>
</div>
<?php echo ads($Ads,1,'my-3');?>
<?php if(count($Similars) > 0) { ?>
<div class="app-section">
<div class="app-heading">
<div class="text">
<?php echo __('Similar content');?>
</div>
</div>
<div class="row row-cols-6 list-scrollable">
<?php foreach ($Similars as $Similar) {?>
<div class="col">
<div class="list-movie">
<a href="<?php echo post($Similar['id'],$Similar['title'],$Similar['type']);?>" class="list-media">
<?php if($Similar['quality'] || $Similar['imdb']) { ?>
<div class="list-media-attr">
<?php if($Similar['quality']) { ?><div class="quality"><?php echo $Similar['quality'];?></div><?php } ?>
<?php if($Similar['imdb']) { ?>
<div class="imdb">
<span>
<?php echo $Similar['imdb'];?></span>
<svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36"><circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Similar['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle></svg>
</div>
<?php } ?>
</div>
<?php } ?>
<div class="play-btn"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" /></svg></div>
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/'.$Similar['image'];?>">
<?php if($Similar['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Similar['mpaa'];?></div><?php } ?>
</div>
</a>
<div class="list-caption">
<a href="<?php echo post($Similar['id'],$Similar['title'],$Similar['type']);?>" class="list-title">
<?php echo $Similar['title'];?>
</a>
<div class="list-year" style="display:inline"><?php if($Similar['create_year']) { ?><?php echo $Similar['create_year'];?><?php } ?> <div class="mpaa float-right" style="display:inline;margin-top: 5px;"><?php echo ($Similar['type'] == 'movie' ? __('Movie') : __('Serie'));?></div></div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if($Listing['comment'] != 1) { ?>
<div class="row">
<div class="col">
<?php require PATH . '/theme/view/common/comments.php';?>
</div>
<?php if(ads($Ads,4,'ml-auto')) { ?><div class="col-md-4"><?php echo ads($Ads,4,'ml-auto');?></div><?php } ?>
</div>
<?php } ?>
</div>
 <?php require PATH . '/theme/view/common/schema.movie.php';?>
<?php require PATH . '/theme/view/common/footer.php';?>
