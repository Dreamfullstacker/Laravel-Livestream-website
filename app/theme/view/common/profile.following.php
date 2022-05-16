<div class="profile-box">
    <div class="profile-heading">
        <?php echo __('Following Contents');?>
    </div>
    <div class="row row-cols-6 list-scrollable">
        <?php 
                            $Follows = $this->db->from(null,'
                                SELECT 
                                posts.id, 
                                posts.title, 
                                posts.self, 
                                posts.image, 
                                posts.quality,
                                posts.imdb,
                                posts.create_year,
                                posts.end_year,
                                posts.mpaa,
                                posts.description,
                                posts.type
                                FROM `follows` 
                                LEFT JOIN posts ON posts.id = follows.content_id  
                                WHERE follows.user_id = "'.$Listing['id'].'" 
                                ORDER BY posts.id
                                LIMIT 0,100')
                                ->all();
                            foreach ($Follows as $Follow) {  
                            ?>
        <div class="col">
            <div class="list-movie">
                <a href="<?php echo post($Follow['id'],$Follow['self'],$Follow['type']);?>" class="list-media">
                    <?php if($Follow['quality'] || $Follow['imdb']) { ?>
                    <div class="list-media-attr">
                        <?php if($Follow['quality']) { ?>
                        <div class="quality">
                            <?php echo $Follow['quality'];?>
                        </div>
                        <?php } ?>
                        <?php if($Follow['imdb']) { ?>
                        <div class="imdb">
                            <span>
                                <?php echo $Follow['imdb'];?></span>
                            <svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36">
                                <circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Follow['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle>
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
                    <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Follow['image'];?>">
<?php if($Follow['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Follow['mpaa'];?></div><?php } ?>
                    </div>
                </a>
                <div class="list-caption">
                    <a href="<?php echo post($Follow['id'],$Follow['self'],$Follow['type']);?>" class="list-title text-12">
                        <?php echo $Follow['title'];?>
                    </a>
<div class="list-year" style="display:inline"><?php if(empty($Follow['end_year'])) { ?><?php echo $Follow['create_year'];?><?php } ?><?php if(!empty($Follow['end_year'])) { ?><?php echo $Follow['create_year'];?> - <?php echo $Follow['end_year'];?><?php } ?> <div class="mpaa float-right" style="display:inline;margin-top: 5px;"><?php echo ($Follow['type'] == 'movie' ? __('Movie') : __('Serie'));?></div></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
