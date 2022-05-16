<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo __('Collections');?></li>
        </ol>
    </nav>
    <?php echo ads($Ads,3,'mb-3');?>
    <div class="d-flex">
        <div class="app-content">
            <div class="app-section">
                <div class="mb-3">
                    <div class="text-24 text-white font-weight-bold"><?php echo __('Collections');?></div>
                </div>
                <!-- movies -->
                <div class="row row-cols-lg-3 row-cols-1 list-grouped">
                    <?php foreach ($Listings as $Listing) { ?>
                		<div class="collection-container">
            				<div class="list-collection" style="width: 100%;background-size: cover;background-position: center;background-image: url('<?php echo $Listing['background'];?>');background-color: <?php echo $Listing['color'];?>;color: <?php echo $Listing['color'];?>">
                				<div class="list-caption">
                    				<center>
                                		<a href="<?php echo 'collection/'; echo $Listing['self'] . '-' . $Listing['id']; ?>" style="padding-top: 40px;padding-bottom: 70px;font-size: 25px; font-weight: bold;" class="list-title">
                                    		<?php if(empty($Listing['background'])){ echo $Listing['name']; } else { } ?>
                                		</a>
                            		</center>
                				</div>
                    		</div>
                        <div style="float:left;width:50%;height: 20px;overflow: hidden;white-space: pre;"><?php echo $Listing['name'];?></div> <div style="float:right;width:50%;text-align:right;"><?php echo $Listing['toplam'];?> items</div>
                		</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
