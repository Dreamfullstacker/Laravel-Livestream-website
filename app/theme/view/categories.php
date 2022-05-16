<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo __('Categories');?></li>
        </ol>
    </nav>
    <?php echo ads($Ads,3,'mb-3');?>
    <div class="d-flex">
        <div class="app-content">
            <div class="app-section">
                <div class="mb-3">
                    <div class="text-24 text-white font-weight-bold"><?php echo __('Categories');?></div>
                </div>
                <div class="row row-cols-md-5 row-cols-2">
                    <?php foreach ($Listings as $Listing) { ?>
                    <div class="col">
                        <a href="<?php echo APP.'/category/'.$Listing['self'];?>" class="list-category-box" style="background-color: <?php echo $Listing['color'];?>" title="<?php echo $Listing['name'];?>">
                            <?php echo $Listing['name'];?>   
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>