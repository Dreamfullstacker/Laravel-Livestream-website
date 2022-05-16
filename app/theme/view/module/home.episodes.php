<div class="app-section">
<div class="app-heading">
<div class="text"><?php echo $HomeModule['name'];?></div>
</div>
<div class="row 
<?php if($ModuleData['listing'] == 'v2') { echo 'row-cols-1 row-cols-md-4 '; } else { echo ' row-cols-2 row-cols-md-5';}?>
<?php if($ModuleData['responsive'] == 'horizontal') echo 'list-scrollable';?>">
<?php
if(!$ModuleData['sorting']) {
$OrderBy = 'id DESC';
}else{
$OrderBy = $ModuleData['sorting'];
}
$Newests = $this->db->from(null,'
SELECT
posts_episode.name as episode_name,
posts_episode.image as episode_image,
posts_season.name as season_name,
posts.id,
posts.title,
posts.self,
posts.image,
posts.cover,
posts.create_year,
posts.imdb,
posts_episode.status,
posts_episode.created,
posts_episode.featured
FROM `posts_episode`
LEFT JOIN posts ON posts_episode.content_id = posts.id
LEFT JOIN posts_season ON posts_season.id = posts_episode.season_id
WHERE posts.type = "serie" AND posts.status = "1" AND posts_episode.status = "1"
ORDER BY posts_episode.'.$ModuleData['sorting'].'
LIMIT 0,'.$HomeModule['data_limit'])
->all();
foreach ($Newests as $Newest) {
?>
<div class="col"> 
<a href="<?php echo APP.'/serie'?>/<?php echo $Newest['title'] . '-' . $Newest['id'] . '/' . $Newest['season_name'] . '-season/' . $Newest['episode_name'] . '-episode'; ?>" class="list-movie 
<?php if($Newest['featured'] == '1') echo 'list-featured';?>
<?php if($ModuleData['listing'] == 'v2') echo 'list-episode';?>">
<div class="list-media">
<?php if($Newest['episode_image']) { ?>
<div class="media media-episode" data-src="<?php echo UPLOAD.'/episode/'.$Newest['episode_image'];?>"></div>
<?php } else { ?>
<div class="media media-episode" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Newest['cover'];?>"></div>
<?php } ?>
<?php if($ModuleData['listing'] != 'v2') { ?>
<div class="list-media-attr">
<div class="date"><?php echo shortdate($Newest['created']);?></div>
</div>
<?php } ?>
</div>
<div class="list-caption">
<div class="list-title"><?php echo $Newest['title'];?></div>
<div class="list-category"><?php echo $Newest['season_name'].'. '.__('Season').' '.$Newest['episode_name'].'. '.__('Episode');?></div>
</div>
<?php if($ModuleData['listing'] == 'v2') { ?>
<div class="list-date"><?php echo shortdate($Newest['created']);?></div> 
<?php } ?>
</a>
</div>
<?php } ?>
</div>
</div>
