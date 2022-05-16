<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-detail flex-fill">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
<li class="breadcrumb-item"><a href="<?php echo APP.'/cursos'?>"><?php echo __('Series');?></a></li>
<li class="breadcrumb-item"><a href="<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>"><?php echo $Listing['title'];?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo __('Season').' '.$Listing['season_name'].' : '.__('Episode').' '.$Listing['episode_name'];?></li>
</ol>
</nav>
<?php require PATH . '/theme/view/common/post.header.php';?>

<?php if(get($Settings,'data.googleadsense','general') == 1) { } else { ?>
<div class="episode-nav">
<?php if($Prev['episode_name']) { ?>
<a href="<?php echo APP.'/curso'?>/<?php echo $Listing['self'] . '-' . $Listing['id'] . '/' . $Prev['season_name'] . '-modulo/' . $Prev['episode_name'] . '-aula'; ?>" class="pr-md-5">
<div class="svg-icon"><svg><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#chevron-left';?>" /></svg></div>
<div class="ml-3">
<div class="name"><?php echo __('Prev episode');?></div>
<div class="episode"><?php echo __('Season').' '.$Prev['season_name'].': '.__('Episode').' '.$Prev['episode_name'];?></div>
</div>
</a>
<?php } ?>
<?php if($Next['episode_name']) { ?>
<a href="<?php echo APP.'/curso'?>/<?php echo $Listing['self'] . '-' . $Listing['id'] . '/' . $Next['season_name'] . '-modulo/' . $Next['episode_name'] . '-aula'; ?>" class="pl-md-5 ml-auto">
<div class="mr-3 text-right">
<div class="name"><?php echo __('Next episode');?></div>
<div class="episode"><?php echo __('Season').' '.$Next['season_name'].': '.__('Episode').' '.$Next['episode_name'];?></div>
</div>
<div class="svg-icon"><svg><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#chevron-right';?>" /></svg></div>
</a>
<?php } ?>
</div>
<?php } ?>
<div class="detail-content">
<div class="cover">
<a href="<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>" class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Listing['image'];?>"></a>
</div>
<div class="detail-text flex-fill">
<div class="caption">
<div class="caption-content">
<a href="<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>">
<h1><?php echo $Listing['title'];?></h1>
</a>
<h3 class="mb-1">
<?php echo __('Season').' '.$Listing['season_name'].': '.__('Episode').' '.$Listing['episode_name'];?> <?php 
if($Listing['episode_id']) {
echo ' - '.$Listing['episode_description'].'';
}
?>
</h3>
</div>
<?php if($Listing['overview']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Episode');?> <?php echo __('Description');?></div>
<div class="text">
<div class="text-content"><?php echo $Listing['overview'];?></div>
</div>
</div>
<?php } ?>
<?php if($Listing['description']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Series');?> <?php echo __('Overview');?></div>
<div class="text">
<div class="text-content"><?php echo $Listing['description'];?></div>
</div>
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
<div class="text"><?php echo $Listing['country_name'];?></div>
</div>
<?php } ?>
<div class="video-attr">
<div class="attr"><?php echo __('Genre');?></div>
<div class="text">
<?php foreach ($Categories as $Category) { ?>
<a href="<?php echo APP.'/cursos/'.$Category['self'];?>">
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
<?php if($Listing['end_year']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('End Date');?></div>
<div class="text"><?php echo $Listing['end_year'];?></div>
</div>
<?php } ?>
<?php if($Listing['series_status']) { ?>
<div class="video-attr">
<div class="attr"><?php echo __('Series Status');?></div>
<div class="text"><?php echo $Listing['series_status'];?></div>
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
<?php echo number_format($Listing['hit']);?><span>
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
<?php if(count($Seasons)>0) { ?>
<div class="season-list">
<div class="seasons">
<ul class="nav" role="tablist">
<?php 
if($Listing['season_name']) {
$SeasonNum = $Listing['season_name'];
}else {
$SeasonNum = 1;
}
foreach ($Seasons as $Season) {
?>
<li class="nav-item">
<a class="nav-link <?php if($Season['name'] == $SeasonNum) echo 'active';?>" id="season-<?php echo $Season['name'];?>-tab" data-toggle="tab" href="#season-<?php echo $Season['name'];?>" role="tab" aria-controls="season-<?php echo $Season['name'];?>" aria-selected="<?php echo ($SeasonNum == $Season['name'] ? 'true' : 'false');?>">
<?php echo __('Season').' '.$Season['name'];?></a>
</li>
<?php } ?>
</ul>
</div>
<div class="episodes tab-content">
<?php foreach ($Seasons as $Season) { ?>
<div class="tab-pane <?php if($Season['name'] == $SeasonNum) echo 'show active';?>" id="season-<?php echo $Season['name'];?>" role="tabpanel" aria-labelledby="season-<?php echo $Season['name'];?>-tab">
<?php 
// Episodes
$Episodes = $this->db->from(null,'
SELECT
posts_episode.id,
posts_episode.name,
posts_episode.description,
posts_episode.created
FROM `posts_episode`
WHERE posts_episode.status = "1" AND posts_episode.content_id = "'.$Listing['id'].'" AND posts_episode.season_id = "'.$Season['id'].'"')
->all();
foreach ($Episodes as $Episode) {
?>
<a href="<?php echo APP.'/curso'?>/<?php echo $Listing['self'] . '-' . $Listing['id'] . '/' . $Season['name'] . '-modulo/' . $Episode['name'] . '-aula'; ?>" <?php if($Episode['name']==$Route->params->episode) echo 'class="active"';?>>
<div class="episode"><?php echo __('Episode').' '.$Episode['name'];?></div>
<div class="name"></div>
</a>
<?php } ?>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if(count($Similars) > 0) { ?>
<div class="app-section">
<div class="app-heading">
<div class="text"><?php echo __('Similar content');?></div>
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
<div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Similar['image'];?>">
<?php if($Similar['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Similar['mpaa'];?></div><?php } ?>
</div>
</a>
<div class="list-caption">
<a href="<?php echo post($Similar['id'],$Similar['title'],$Similar['type']);?>" class="list-title">
<?php echo $Similar['title'];?>
</a>
<div class="list-year" style="display:inline"><?php if(empty($Similar['end_year'])) { ?><?php echo $Similar['create_year'];?><?php } ?><?php if(!empty($Similar['end_year'])) { ?><?php echo $Similar['create_year'];?> - <?php echo $Similar['end_year'];?><?php } ?> <div class="mpaa float-right" style="display:inline;margin-top: 5px;"><?php echo ($Similar['type'] == 'movie' ? __('Movie') : __('Serie'));?></div></div>
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
<?php if(ads($Ads,4,'ml-auto')) { ?>
<div class="col-md-4">
<?php echo ads($Ads,4,'ml-auto');?>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
<?php require PATH . '/theme/view/common/schema.episode.php';?>
<?php require PATH . '/theme/view/common/footer.php';?>
