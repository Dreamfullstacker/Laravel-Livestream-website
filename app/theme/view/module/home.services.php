<div class="app-section">
    <div class="app-heading">
        <div class="text">
            <?php echo $HomeModule['name'];?>
        </div>
        <a href="<?php echo APP.'/services';?>" class="all"><?php echo __('All');?></a>
    </div>
    <div class="row row-wrap row-cols-lg-3 row-cols-md-2 list-scrollable list-scrollablev2 list-grouped" style="margin-top:-10px;">
        <?php    
        $Collections = $this->db->from(null,'
            SELECT 
            collections.id,
            collections.name,
            collections.self,
            collections.user_id,
            collections.color,
            collections.background,
            collections.self,
            users.username,
            users.avatar,
            IFNULL(p.toplam, 0) AS toplam
            FROM `collections` 
            LEFT JOIN (
              SELECT collection_id, count(collections_post.content_id) AS toplam
              FROM collections_post 
              GROUP BY collection_id
            ) p ON (collections.id = p.collection_id)
            LEFT JOIN users ON users.id = collections.user_id  
            WHERE collections.featuredservice = "1" AND collections.privacy = "1"
            ORDER BY collections.'.$ModuleData['sorting'].'
            LIMIT 0,'.$HomeModule['data_limit'])
            ->all();
        foreach ($Collections as $Collection) {
        ?>

        <div class="col">
                		<div class="collection-container">
            				<div class="list-collection" style="width: 100%;background-size: cover;background-position: center;background-image: url('<?php echo $Collection['background'];?>');background-color: <?php echo $Collectiong['color'];?>;color: <?php echo $Collectiong['color'];?>">
                				<div class="list-caption">
                    				<center>
                                		<a href="<?php echo 'collection/'; echo $Collection['self'] . '-' . $Collection['id']; ?>" style="padding-top: 40px;padding-bottom: 70px;font-size: 25px; font-weight: bold;" class="list-title">
                                    		<?php if(empty($Collection['background'])){ echo $Collection['name']; } else { } ?>
                                		</a>
                            		</center>
                				</div>
                    		</div>
                        <div style="margin-bottom:10px;float:left;width:50%;height: 20px;overflow: hidden;white-space: pre;"><?php echo $Collection['name'];?></div> <div style="float:right;width:50%;text-align:right;"><?php echo $Collection['toplam'];?> items</div>
                		</div>
        </div>
        <?php } ?>
    </div>
</div>
