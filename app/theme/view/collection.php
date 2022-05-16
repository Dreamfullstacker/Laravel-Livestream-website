<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo APP.'/collections';?>"><?php echo __('Collections');?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $Listing['name'];?>
            </li>
        </ol>
    </nav>
    <?php echo ads($Ads,3,'mb-3');?>
    <div class="collection-detail">
        <form method="post">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
            <h1>
                <?php echo $Listing['name'];?>
            </h1>
        	<?php if($Listing['background']) {?><div style="background-image: url('<?php echo $Listing['background'];?>');width: 100%;background-size: cover;background-position: center;border-radius:5px;max-height:400px;margin-bottom:10px;margin-top:10px;padding-top: 45%; /* 1:1 Aspect Ratio */"></div><?php } ?>
            <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" required="true">
			<input type="text" name="background" class="form-control form-control-lg" placeholder="<?php echo __('Background URL');?>" value="<?php echo $Listing['background'];?>" required="true">
            <div class="collection-footer">
<?php echo __('created');?> <?php echo __('by');?> <a style="color:var(--theme-color)" href="<?php echo profile($Listing['id'],$Listing['username']);?>" class="user"><?php echo $Listing['loginname'];?></a> <?php echo timeago($Listing['created']);?>
                <?php if($AuthUser['id'] == $Listing['user_id']) { ?>
                <a href="#" class="edit"><?php echo __('Edit');?></a>
                <?php } ?>
            </div>		
            <button type="submit" class="btn btn-theme"><?php echo __('Save Changes');?></button>
            <!-- movies -->
            <div class="row row-cols-md-6 row-cols-2">
                <?php foreach ($Collections as $Collection) {?>
                <div class="col">
                    <div class="list-movie">
                        <input class="d-none" name="post[]" type="checkbox" value="<?php echo $Collection['id'];?>">
                        <a href="<?php echo post($Collection['content_id'],$Collection['self'],$Collection['type']);?>" class="list-media">
                    <?php if($Collection['quality'] || $Collection['imdb']) { ?>
                    <div class="list-media-attr">
                        <?php if($Collection['quality']) { ?>
                        <div class="quality">
                            <?php echo $Collection['quality'];?>
                        </div>
                        <?php } ?>
                        <?php if($Collection['imdb']) { ?>
                        <div class="imdb">
                            <span>
                                <?php echo $Collection['imdb'];?></span>
                            <svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36">
                                <circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Collection['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle>
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
                            <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/'.$Collection['image'];?>">
<?php if($Collection['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Collection['mpaa'];?></div><?php } ?>
			    </div>
                        </a>
                        <div class="list-caption">
                            <a href="<?php echo post($Collection['content_id'],$Collection['self'],$Collection['type']);?>" class="list-title">
                                <?php echo $Collection['title'];?>
                            </a>
<div class="list-year" style="display:inline"><?php if(empty($Collection['end_year'])) { ?><?php echo $Collection['create_year'];?><?php } ?><?php if(!empty($Collection['end_year'])) { ?><?php echo $Collection['create_year'];?> - <?php echo $Collection['end_year'];?><?php } ?> <div class="mpaa float-right" style="display:inline;margin-top: 5px;"><?php echo ($Collection['type'] == 'movie' ? __('Movie') : __('Serie'));?></div></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- movies -->
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).on('click', '.collection-edit .list-movie', function(e) {
    if ($(this).find('[type="checkbox"]').is(":checked")) {
        $(this).find('[type="checkbox"]').prop("checked", false);
        $(this).removeClass("checked");
    } else {
        $(this).find('[type="checkbox"]').prop("checked", true);
        $(this).addClass("checked");
    }
    return false;
});
$(document).on('click', '.edit', function(e) {

    if ($('.collection-detail').hasClass('collection-edit')) {
        $(this).text('<?php echo __('Edit');?>');
    } else {
        $(this).text('<?php echo __('Cancel');?>');
    }
    $('.collection-detail').toggleClass('collection-edit');
    return false;
});
</script>
<?php require PATH . '/theme/view/common/footer.php';?>
