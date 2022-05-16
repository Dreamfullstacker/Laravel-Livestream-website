<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-detail flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo APP.'/tv-channels'?>">
                    <?php echo __('TV Channels');?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $Listing['name'];?>
            </li>
        </ol>
    </nav>
    <?php echo ads($Ads,3,'mb-3');?>
    <div class="app-detail-embed">
        <div class="embed-col">
            <div class="spinner d-none">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
            <div class="embed-play">
                <?php if($Listing['embed']) { ?>
                <?php if($Data['politicy'] == 1) { ?>
                <div class="embed-lock">
                    <div class="heading">
                        <?php echo __('Removed');?>
                    </div>
                    <div class="subtext">
                        <?php echo __('Content was removed at the request of the rights holder.');?>
                    </div>
                </div>
                <?php } else { ?>
                <?php if($Data['private'] == '1' AND !$AuthUser['id']) { ?>
                <div class="embed-lock">
                    <svg class="icon">
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#alert';?>" />
                    </svg>
                    <div class="heading">
                        <?php echo __('Members Only');?>
                    </div>
                    <div class="subtext">
                        <?php echo __('This content is only for members.');?> <a href="<?php echo APP.'/login';?>" class="text-white font-weight-bold">
                            <?php echo __('Login');?></a>, <a href="<?php echo APP.'/register';?>" class="text-white font-weight-bold">
                            <?php echo __('Register');?></a></div>
                </div>
                <?php } else { ?> 
                <div class="embed-responsive-item"><iframe class="embed-responsive-item" src="<?php echo $Listing['embed'];?>" allowfullscreen></iframe></div>
                <?php } ?>
                <?php } ?>
                <?php } else { ?>
                <div class="embed-lock">
                    <div class="heading">
                        <?php echo __('Not yet available !');?>
                    </div>
                    <div class="subtext">
                        <?php echo __('Content not yet trackable');?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php echo ads($Ads,2,'embed-ads');?>
    </div>
    <div class="detail-content">
        <div class="cover">
            <div class="media" data-src="<?php echo UPLOAD.'/channel/'.$Listing['image'];?>"></div>
        </div>
        <div class="detail-text flex-fill">
            <div class="caption">
                <div class="caption-content">
                    <div class="category">
                        <?php foreach ($Categories as $Category) { ?>
                        <a href="<?php echo APP.'/movies/'.$Category['self'];?>">
                            <?php echo $Category['name'];?></a>
                        <?php } ?>
                    </div>
                    <h1>
                        <?php echo $Listing['name'];?>
                    </h1>
                </div>
                <?php if($Listing['description']) { ?>
                <div class="video-attr">
                    <div class="attr">
                        <?php echo __('Overview');?>
                    </div>
                    <div class="text">
                        <?php echo $Listing['description'];?>
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
            </div> 
        </div>
    </div>
    <?php echo ads($Ads,1,'my-3');?>
    <?php if(count($Similars) > 0) { ?>
    <div class="app-section">
        <div class="app-heading">
            <div class="text">
                <?php echo __('Similar content');?>
            </div>
        </div>
        <div class="row row-cols-6 list-scrollable">
            <?php foreach ($Similars as $Similar) {?>
            <div class="col">
                <div class="list-movie">
                    <a href="<?php echo post($Similar['id'],$Similar['self'],$Similar['type']);?>" class="list-media">
                        <?php if($Similar['quality']) { ?>
                        <div class="list-media-attr">
                            <div class="quality">
                                <?php echo $Similar['quality'];?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="play-btn">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" />
                            </svg>
                        </div>
                        <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Similar['image'];?>"></div>
                    </a>
                    <div class="list-caption">
                        <a href="<?php echo post($Similar['id'],$Similar['self'],$Similar['type']);?>" class="list-title">
                            <?php echo $Similar['title'];?>
                        </a>
                        <a href="<?php echo post($Similar['id'],$Similar['self'],$Similar['type']);?>" class="list-category">
                            <?php echo $Similar['create_year'];?>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if($Data['comment'] != 1) { ?>
    <div class="row">
        <div class="col">
            <?php require PATH . '/theme/view/common/comments.php';?>
        </div>
        <?php if(ads($Ads,4,'ml-auto')) { ?>
        <div class="col-md-4">
            <?php echo ads($Ads,4,'ml-auto');?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</div> 
<?php require PATH . '/theme/view/common/footer.php';?>
