<div class="app-section">
<div class="app-trailer">
<div class="row row-cols-7 list-story">
<?php
if(!$ModuleData['sorting']) {
$OrderBy = 'id DESC';
}else{
$OrderBy = $ModuleData['sorting'];
}
$Stories = $this->db->from(null,'
SELECT
stories.title,
stories.subtitle,
stories.image,
stories.embed,
stories.link,
stories.color,
posts.id,
posts.self,  
posts.create_year,
posts.imdb,
posts.type,
posts.created
FROM `stories`
LEFT JOIN posts ON posts.id = stories.content_id
WHERE posts.status = "1"
ORDER BY stories.featured ASC,stories.id DESC
LIMIT 0,7')
->all();
foreach ($Stories as $Story) { ?>
<div class="col">
<?php if($Story['embed']) { ?>
<a href="javascript:;" data-toggle="modal" data-target="#lg" data-remote="<?php echo APP.'/modal/story?id='.$Story['id'];?>" class="list-trailer">
<?php } elseif($Story['link']) { ?>
<a href="<?php echo ($Story['link'] ? $Story['link'] : '#');?>" class="list-trailer">
<?php } else { ?>
<a href="<?php echo post($Story['id'],$Story['title'],$Story['type']);?>" class="list-trailer">
<?php } ?>
<div class="media-story <?php if($Story['color']) echo 'active';?>" style="background-color: <?php echo $Story['color'];?>">
<div class="media" data-src="<?php echo UPLOAD.'/story/'.$Story['image'];?>"></div>
</div>
<div class="list-caption">
<div class="list-title"><?php echo $Story['title'];?></div>
<div class="list-description"><?php echo $Story['subtitle'];?></div>
</div>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
