<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item active"><a href="<?php echo APP.'/trends';?>"><?php echo __('Trends');?></a></li>
</ol>
</nav>
<div class="app-content">
<div class="app-section">
<div class="mb-4">
<div class="text-24 text-white font-weight-bold"><?php echo __('Trends');?></div>
<div class="subtext text-12"><?php echo $Config['description'];?></div>
</div> 
<?php
$Trends = $this->db->from(null,'
SELECT
posts.id,
posts.title_sub,
posts.title,
posts.hit,
posts.image,
posts.imdb,
posts.create_year,
posts.end_year,
posts.mpaa,
posts.description,
posts.duration,
categories.name,
countries.name as country_name,
posts.self,
posts.type
FROM `posts`
LEFT JOIN posts_category ON posts_category.content_id = posts.id
LEFT JOIN categories ON categories.id = posts_category.category_id
LEFT JOIN countries ON countries.id = posts.country
WHERE posts.status = "1"
GROUP BY posts.id
ORDER BY posts.hit DESC
LIMIT 0,10')
->all();
$i=1;
foreach ($Trends as $Trend) {
?>
<a href="<?php echo post($Trend['id'],$Trend['title'],$Trend['type']);?>" class="list-trend">
<div class="list-media">
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/'.$Trend['image'];?>"></div>
</div>
<div class="list-caption">
<div class="list-title-sub"><?php echo $Trend['title_sub'];?></div>
<div class="list-title"><?php echo $Trend['title'];?></div> 
<div class="list-attr-box mb-2">
<?php if($Trend['name']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('Category');?></div>
<div class="text"><?php echo $Trend['name'];?></div>
</div>
<?php } ?>
<?php if($Trend['imdb']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('IMDB');?></div>
<div class="text"><?php echo $Trend['imdb'];?></div>
</div>
<?php } ?>
<?php if($Trend['country_name']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('Country');?></div>
<div class="text"><?php echo $Trend['country_name'];?></div>
</div>
<?php } ?>
<?php if($Trend['mpaa']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('MPAA');?></div>
<div class="text"><?php echo $Trend['mpaa'];?></div>
</div>
<?php } ?>
<?php if($Trend['duration']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('Duration');?></div>
<div class="text"><?php echo $Trend['duration'].' '.__('min');?></div>
</div>
<?php } ?>
<?php if($Trend['create_year']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('Release Date');?></div>
<div class="text"><?php echo $Trend['create_year'];?></div>
</div>
<?php } ?>
<?php if($Trend['end_year']) { ?>
<div class="list-attr">
<div class="attr"><?php echo __('End Date');?></div>
<div class="text"><?php echo $Trend['end_year'];?></div>
</div>
<?php } ?>
</div>
<div class="list-description"><?php echo $Trend['description'];?></div>
<div class="list-view">
<svg><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#trend';?>" /></svg>
<?php echo $Trend['hit'];?>
<span><?php echo __('view');?></span>
</div>
</div>
</a>
<?php $i++;} ?>
</div>
</div>
</div>
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "WebSite",
"url": "<?php echo APP;?>",
"potentialAction": {
"@type": "SearchAction",
"target": "<?php echo APP.'/arama/';?>{search_term}",
"query-input": "required name=search_term"
}
}
</script>
<?php require PATH . '/theme/view/common/footer.php';?>
