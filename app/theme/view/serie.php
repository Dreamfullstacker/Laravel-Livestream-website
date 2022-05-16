<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-detail flex-fill">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
         <li class="breadcrumb-item"><a href="<?php echo APP.'/cursos'?>"><?php echo __('Series');?></a></li>
         <li class="breadcrumb-item active" aria-current="page"><?php echo $Listing['title'];?></li>
      </ol>
   </nav>
   
   <div>
      <center>
         <?php if($Listing['politicy'] == 1) { ?>
         <div class="embed-lock">
            <button type="button" class="btn btn-theme px-5 my-3 mr-2">
               <div class="heading"><?php echo __('Removed');?></div>
               <div class="subtext"><?php echo __('Content was removed at the request of the rights holder.');?></div>
            </button>
         </div>
         
         <?php } else { ?>
         <?php if($Listing['private'] == '1' AND !$AuthUser['id']) { ?>
         <div class="embed-lock">
            <button type="button" class="btn btn-theme px-5 my-3 mr-2">
               <svg class="icon">
                  <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#alert';?>" />
               </svg>
               <div class="heading"><?php echo __('Members Only');?></div>
               <div class="subtext"><?php echo __('This content is only for members.');?> <a href="<?php echo APP.'/login';?>" class="text-white font-weight-bold"><?php echo __('Login');?></a>, <a href="<?php echo APP.'/register';?>" class="text-white font-weight-bold"><?php echo __('Register');?></a></div>
            </button>
         </div>
         <?php } else { ?>
         
         <?php } ?>
         <?php } ?>
      </center>
   </div>
   <?php echo ads($Ads,3,'mb-3');?>
   <div class="detail-content">
      <div class="col-md-3">
         <div class="media media-cover mb-2" data-src="<?php echo UPLOAD.'/cover/'.$Listing['image'];?>"></div>
         <?php if($Listing['trailer']) { ?>
         <button type="button" class="btn btn-theme-lt mr-2 px-md-5 mb-2 trailer" data-toggle="modal" data-target="#lg" data-remote="<?php echo APP.'/modal/trailer?trailer='.urlencode($Listing['trailer']);?>">
         <?php echo __('Trailer');?></button>
         <?php } ?>
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
                  <svg>
                     <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#like';?>" />
                  </svg>
                  <span data-votes="<?php echo $Listing['likes'];?>"><?php echo $Listing['likes'];?></span>
               </div>
               <div class="action-btn dislike <?php if($Vote['reaction'] == 'down') echo 'active';?>" data-id="<?php echo $Listing['id'];?>">
                  <svg>
                     <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#dislike';?>" />
                  </svg>
                  <span data-votes="<?php echo $Listing['dislikes'];?>"><?php echo $Listing['dislikes'];?></span>
               </div>
            </div>
         </div>
      </div>
      
         <div class="col-md-9">
            <div class="pl-md-4">
               <h1><?php echo $Listing['title'];?></h1>
               <?php if($Listing['title_sub']) { ?><?php echo __('Also Known As');?>: 
               <h2 style="display:inline;"><?php echo $Listing['title_sub'];?></h2>
               <br /><?php } ?><a href="<?php echo $_SERVER['REQUEST_URI']; echo '/1-modulo/1-aula'; ?>"><button type="button" class="btn btn-theme px-5 my-3 mr-2">Assistir Agora</button></a>
            </div>
            
            <?php if($Listing['description']) { ?>
           
            <?php } ?>
            <?php if($Listing['imdb']) { ?>
            <div class="video-attr">
               <div class="attr"><?php echo __('Nota');?></div>
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
                  <a href="<?php echo APP.'/cursos/'.$Category['self'];?>">
                  <?php echo $Category['name'];?></a>
                  <?php } ?>
               </div>
            </div>
            
            <?php if($Listing['duration']) { ?>
            <div class="video-attr">
               <div class="attr"><?php echo __('Duration');?></div>
               <div class="text"><?php echo $Listing['duration'].' '.__('Horas');?></div>
            </div>
            <?php } ?>
            <?php if($Listing['create_year']) { ?>
            <div class="video-attr">
               <div class="attr"><?php echo __('Release Date');?></div>
               <div class="text"><?php echo $Listing['create_year'];?></div>
            </div>
            <?php } ?>
           
            <?php if($Listing['series_status']) { ?>
            <div class="video-attr">
               <div class="attr"><?php echo __('Series Status');?></div>
               <div class="text"><?php echo $Listing['series_status'];?></div>
            </div>
             <div class="video-attr">
               <div class="attr"><?php echo __('Overview');?></div>
               <div class="text"><?php echo $Listing['description'];?></div>
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
                  <svg class="icon">
                     <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$key;?>" />
                  </svg>
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
         
   </div>
   <div class="col-md-12">
      <?php echo ads($Ads,1,'my-3');?>
      <?php
         // Season
         $Seasons = $this->db->from(null,'
         SELECT
         posts_season.id,
         posts_season.name
         FROM `posts_season`
         WHERE posts_season.content_id = "'.$Listing['id'].'"
         ORDER BY cast(name as unsigned) ASC')
         ->all();
         ?>
      <?php if(count($Seasons)>0) { ?>
      <div class="season-list">
         <div class="seasons">
            <ul class="nav" role="tablist">
               <?php 
                  $i=0;
                  foreach ($Seasons as $Season) {
                  ?>
               <li class="nav-item">
                  <a class="nav-link <?php if($i == 0) echo 'active';?>" id="season-<?php echo $Season['name'];?>-tab" data-toggle="tab" href="#season-<?php echo $Season['name'];?>" role="tab" aria-controls="season-<?php echo $Season['name'];?>" aria-selected="<?php echo ($i == 0 ? 'true' : 'false');?>">
                  <?php echo __('Season').' '.$Season['name'];?></a>
               </li>
               <?php $i++; } ?>
            </ul>
         </div>
         <div class="episodes tab-content">
            <?php 
               $i=0; 
               foreach ($Seasons as $Season) { 
               ?>
            <div class="tab-pane <?php echo ($i == 0 ? 'show active' : '');?>" id="season-<?php echo $Season['name'];?>" role="tabpanel" aria-labelledby="season-<?php echo $Season['name'];?>-tab">
               <?php
                  // Episodes
                  $Episodes = $this->db->from(null,'
                  SELECT
                  posts_episode.id,
                  posts_episode.name,
                  posts_episode.description,
                  posts_episode.created
                  FROM `posts_episode`
                  WHERE posts_episode.status = "1" AND posts_episode.content_id = "'.$Listing['id'].'" AND posts_episode.season_id = "'.$Season['id'].'"
                  ')
                  ->all();
                  foreach ($Episodes as $Episode) {
                  ?>
               <a href="<?php echo APP.'/curso'?>/<?php echo $Listing['self'] . '-' . $Listing['id'] . '/' . $Season['name'] . '-modulo/' . $Episode['name'] . '-aula'; ?>" class="pl-md-5 ml-auto">
                  <div class="episode"><?php echo __('Episode').' '.$Episode['name'];?></div>
                  <div class="name"></div>
               </a>
               <?php } ?>
            </div>
            <?php $i++; } ?>
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
                  <a href="<?php echo post($Similar['id'],$Similar['self'],$Similar['type']);?>" class="list-media">
                     <?php if($Similar['quality'] || $Similar['imdb']) { ?>
                     <div class="list-media-attr">
                        <?php if($Similar['quality']) { ?>
                        <div class="quality"><?php echo $Similar['quality'];?></div>
                        <?php } ?><?php if($Similar['imdb']) { ?>
                        <div class="imdb">
                           <span>
                           <?php echo $Similar['imdb'];?></span>
                           <svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36">
                              <circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Similar['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle>
                           </svg>
                        </div>
                        <?php } ?>
                     </div>
                     <?php } ?>
                     <div class="play-btn">
                        <svg class="icon">
                           <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" />
                        </svg>
                     </div>
                     <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Similar['image'];?>">
                        <?php if($Similar['mpaa']) { ?>
                        
                        <div class="media-cover mpaa"><?php echo $Similar['mpaa'];?></div>
                        <?php } ?>
                     </div>
                  </a>
                  <div class="list-caption">
                     <a href="<?php echo post($Similar['id'],$Similar['title'],$Similar['type']);?>" class="list-title">
                     <?php echo $Similar['title'];?>
                     </a>
                     <div class="list-year" style="display:inline">
                        <?php if(empty($Similar['end_year'])) { ?><?php echo $Similar['create_year'];?><?php } ?><?php if(!empty($Similar['end_year'])) { ?><?php echo $Similar['create_year'];?> - <?php echo $Similar['end_year'];?><?php } ?> 
                        <div class="mpaa float-right" style="display:inline;margin-top: 5px;"><?php echo ($Similar['type'] == 'movie' ? __('Movie') : __('Serie'));?></div>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
      <?php } ?>
      <?php if($Listing['comment'] != 1) { ?>
      <div class="row">
         <div class="col"><?php require PATH . '/theme/view/common/comments.php';?></div>
         <?php if(ads($Ads,4,'ml-auto')) { ?>
         <div class="col-md-4"><?php echo ads($Ads,4,'ml-auto');?></div>
         <?php } ?>
      </div>
      <?php } ?>
   </div>
</div>
</div>
<?php require PATH . '/theme/view/common/schema.serie.php';?>
<?php require PATH . '/theme/view/common/footer.php';?>