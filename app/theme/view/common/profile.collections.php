<div class="row row-cols-lg-3 row-cols-md-2 list-grouped">
    <?php foreach ($Collections as $Collection) { ?>
    <div class="col">
                		<div>
            				<div class="list-collection" style="width: 100%;background-size: cover;background-position: center;background-image: url('<?php echo $Collection['background'];?>');background-color: <?php echo $Collection['color'];?>;color: <?php echo $Collection['color'];?>">
                				<div class="list-caption">
                    				<center>
                                		<a href="<?php echo APP.'/collection/'; echo $Collection['self'] . '-' . $Collection['id']; ?>" style="padding-top: 40px;padding-bottom: 70px;font-size: 25px; font-weight: bold;" class="list-title">
                                    		<?php if(empty($Collection['background'])){ echo $Collection['name']; } else { } ?>
                                		</a>
                            		</center>
                				</div>
                    		</div>
                        <div style="float:left;width:50%;height: 20px;overflow: hidden;white-space: pre;"><?php echo $Collection['name'];?></div> <div style="float:right;width:50%;text-align:right;"><?php echo $Collection['toplam'];?> items</div>
                		</div>
    </div>
    <?php } ?>
</div>
