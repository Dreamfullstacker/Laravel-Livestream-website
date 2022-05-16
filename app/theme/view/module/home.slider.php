<div class="app-section">
<div class="app-slider">
<?php
if(!$ModuleData['sorting']) {
$OrderBy = 'id DESC';
}else{
$OrderBy = $ModuleData['sorting'];
}
$Slides = $this->db->from(null,'
SELECT
posts.id,
slider.title,
posts.self,  
slider.image,
posts.create_year,
posts.mpaa,
posts.quality,
posts.duration,
posts.cover,
posts.description,
slider.body,
slider.link,
posts.imdb,
posts.type,
posts.created
FROM `slider`
LEFT JOIN posts ON posts.id = slider.content_id
WHERE posts.status = "1"
ORDER BY slider.id DESC')
->all();
$iSlider = 0;
?>
<div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
<div class="carousel-inner">
<ol class="carousel-indicators">
<?php
$iSlide=0;
foreach ($Slides as $Slide) { ?>
<li data-target="#slider" data-slide-to="<?php echo $iSlide;?>" class="<?php if($iSlide == 0) echo 'active';?>"></li>
<?php $iSlide++;} ?>
</ol>
<?php foreach ($Slides as $Slide) { ?>
<div class="carousel-item <?php if($iSlider == 0) echo 'active';?>">
<?php if($Slide['image']) { ?>
<a href="<?php if (empty($Slide['link'])) { echo post($Slide['id'],$Slide['title'],$Slide['type']);  } else { echo $Slide['link']; }?>" class="slide media media-slide" data-src="<?php echo UPLOAD.'/slide/'.$Slide['image'];?>">
<?php } else { ?>
<a href="<?php if (empty($Slide['link'])) { echo post($Slide['id'],$Slide['title'],$Slide['type']);  } else { echo $Slide['link']; }?>" class="slide media media-slide" data-src="<?php echo UPLOAD.'/cover/large-'.$Slide['cover'];?>">
<?php } ?>
<div class="slide-caption">
<div class="d-flex align-items-center">
<div>
<div class="title">
<?php echo $Slide['title'];?>
</div>
<div class="slide-header">
<div class="imdb"><b>IMDB</b> <?php echo $Slide['imdb'];?></div>
<div>
<?php echo $Slide['create_year'];?>
</div>
<div class="category text-12">
<?php echo ($Slide['type'] == 'movie' ? __('Movie') : __('Serie'));?>
</div>
<?php if($Slide['duration']) { ?><div class="duration"><?php echo $Slide['duration'].' '.__('min');?></div><?php } ?>
<?php if($Slide['quality']) { ?><div class="quality"><?php echo $Slide['quality'];?></div><?php } ?>
<?php if($Slide['mpaa']) { ?><div class="mpaa"><?php echo $Slide['mpaa'];?></div><?php } ?>
</div>
<div class="description"><?php if($Slide['body']) { ?><?php echo $Slide['body'];?><?php } else { ?><?php echo $Slide['description'];?><?php } ?></div>
</div>
</div>
</div>
</a>
</div>
<?php $iSlider++; } ?>
</div>
<?php if(count($Slides) > 1) { ?>
<div class="carousel-control-next">
<a class="control-next floatright" href="#slider" role="button" data-slide="next" aria-label="Next">
<svg><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#chevron-right';?>" /></svg>
</a>
</div>
<div class="carousel-control-prev">
<a class="control-prev floatleft" href="#slider" role="button" data-slide="prev" aria-label="Prev">
<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo ASSETS.'/img/sprite.svg#chevron-left';?>" /></svg>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
