<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>">
                    <?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo __('TV Channels');?>
            </li>
        </ol>
    </nav>
    <?php echo ads($Ads,3,'mb-3');?>
    <div class="app-section">
        <div class="mb-3">
            <div class="text-24 text-white font-weight-bold">
                <?php echo __('TV Channels');?>
            </div>
        </div>
    </div>
    <!-- movies -->
    <div class="row row-cols-md-5 row-cols-2">
        <?php foreach ($Listings as $Listing) {?>
        <div class="col">
            <div class="list-movie">
                <a href="<?php echo channel($Listing['id'],$Listing['self']);?>" class="list-media">
                    <div class="play-btn">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" />
                        </svg>
                    </div>
                    <div class="media" data-src="<?php echo UPLOAD.'/channel/'.$Listing['image'];?>"></div>
                </a>
                <div class="list-caption text-center">
                    <a href="<?php echo channel($Listing['id'],$Listing['self']);?>" class="list-title">
                        <?php echo $Listing['name'];?>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- movies -->
    <?php echo $Pagination;?>
    <div class="text-muted text-12">
        <?php if($TotalRecord == 0) { ?>
        <?php echo __('No content found');?>
        <?php } else { ?>
        <?php echo $TotalRecord;?>
        <?php echo __('contains content');?>
        <?php } ?>
    </div>
</div>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "<?php echo APP;?>",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "<?php echo APP.'/arama/';?>{search_term}",
        "query-input": "required name=search_term"
    }
}
</script>
<?php require PATH . '/theme/view/common/footer.php';?>
