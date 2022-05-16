<?php require PATH . '/view/common/header.php';?>
    <div class="row row-cols-md-5 row-cols-1">
        <?php foreach ($Listings as $Listing) { ?>
        <div class="col">
        	<a href="<?php echo APP.'/admin/'.$Listing['filename'];?>" class="card card-tool">
        		<div class="card-body text-center py-5">
        			<svg class="brand-svg">
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$Listing['favicon'].'';?>" />
                    </svg>
        			<div class="head"><?php echo $Listing['name'];?></div>
        		</div>
        	</a>
        </div>
        <?php } ?>
    </div>
<?php require PATH . '/view/common/footer.php';?>