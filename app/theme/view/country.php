<?php

include '../app/config/db.config.php';
$str 			= APP . $_SERVER["REQUEST_URI"]; 
$match 			= substr(strrchr($str, "/"), 1 );
$matchthis = str_replace('-', ' ', $match);
$conn 			= mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$result 		= $conn->query('SELECT * FROM countries WHERE countries.name= "'.$matchthis.'"');
$conn2 			= mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$result2 		= $conn2->query('SELECT * FROM countries WHERE countries.name= "'.$matchthis.'"');

?>
<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo APP . '/countries';?>"><?php echo __('Countries');?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php while ($row2 = $result2->fetch_assoc()) { echo $row2['name']; } ?></li>
        </ol>
    </nav>
</div>
                    <div class="text-24 text-white font-weight-bold">
<?php
                    
while ($row = $result->fetch_assoc()) { echo $row['name']; }

?>
                    </div>
<br>
    <div class="d-flex">
        <div class="app-content">
            <div class="app-section">
                <!-- movies -->
                    <div class="row row-cols-2 row-cols-md-5">
                        <?php foreach ($Listings as $Listing) {?>
                        <div class="col">
                            <div class="list-movie">
                                <a href="<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>" class="list-media">
                                    <?php if($Listing['quality'] || $Listing['imdb']) { ?>
                                    <div class="list-media-attr">
                                        <?php if($Listing['quality']) { ?>
                                        <div class="quality">
                                            <?php echo $Listing['quality'];?>
                                        </div>
                                        <?php } ?>
                                        <?php if($Listing['imdb']) { ?>
                                        <div class="imdb">
                                            <span>
                                                <?php echo $Listing['imdb'];?></span>
                                            <svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36">
                                                <circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Listing['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle>
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
                                    <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/'.$Listing['image'];?>">
<?php if($Listing['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Listing['mpaa'];?></div><?php } ?>
                                    </div>
                                </a>
                                <div class="list-caption">
                                    <a href="<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>" class="list-title">
                                        <?php echo $Listing['title'];?>
                                    </a>
<div class="list-year" style="display:inline"><?php if(empty($Listing['end_year'])) { ?><?php echo $Listing['create_year'];?><?php } ?><?php if(!empty($Listing['end_year'])) { ?><?php echo $Listing['create_year'];?> - <?php echo $Listing['end_year'];?><?php } ?> <div class="mpaa float-right" style="display:inline;margin-top: 5px;"><?php echo ($Listing['type'] == 'movie' ? __('Movie') : __('Serie'));?></div></div>                                </div>
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
        </div>
    </div>
<?php require PATH . '/theme/view/common/footer.php';?>
