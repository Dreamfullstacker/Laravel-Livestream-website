        <div class="profile-box">
            <div class="row row-cols-6 list-scrollable">
                <?php 
                            $Follows = $this->db->from(null,'
                                SELECT 
                                posts.id, 
                                posts.title, 
                                posts.self, 
                                posts.image, 
                                posts.type
                                FROM `reactions` 
                                LEFT JOIN posts ON posts.id = reactions.content_id  
                                WHERE reactions.reaction = "up" AND reactions.user_id = "'.$Listing['id'].'" 
                                ORDER BY posts.id
                                LIMIT 0,10')
                                ->all();
                            foreach ($Follows as $Follow) {  
                            ?>
                <div class="col">
                    <div class="list-movie">
                        <a href="<?php echo post($Follow['id'],$Follow['self'],$Follow['type']);?>" class="list-media">
                            <div class="play-btn">
                                <svg class="icon">
                                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" />
                                </svg>
                            </div>
                            <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Follow['image'];?>"></div>
                        </a>
                        <div class="list-caption">
                            <a href="<?php echo post($Follow['id'],$Follow['self'],$Follow['type']);?>" class="list-title text-12">
                                <?php echo $Follow['title'];?>
                            </a>
                            <a href="<?php echo post($Follow['id'],$Follow['self'],$Follow['type']);?>" class="list-category">
                                <?php echo ($Follow['type'] == 'movie' ? __('Movie') : __('Serie'));?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
