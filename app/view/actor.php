<?php require PATH . '/view/common/header.php';?>
<form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
    <div class="d-md-flex">
        <div class="flex-fill">
            <div class="form-toolbar">
                <div class="nav-active-border b-primary bottom">
                    <ul class="nav" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="contents-tab" data-toggle="tab" href="#contents" role="tab" aria-controls="contents" aria-selected="true"><?php echo __('General');?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="false"><?php echo __('Movies and Series');?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_FORMTOKEN" value="<?php echo $Token; ?>">
            <div class="tab-content">
                <div class="tab-pane show active" id="contents" role="tabpanel" aria-labelledby="contents-tab">
                    <?php require PATH . '/view/common/actor.tab.content.php';?>
                </div>
                <div class="tab-pane" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                    <?php require PATH . '/view/common/actor.tab.videos.php';?>
                </div>
            </div>
        </div>
        <div class="app-aside-right">
            <div class="form-group">
                <div class="media-select media media-actor" style="background-image: url(<?php if($Listing['image']) echo UPLOAD.'/actor/'.$Listing['image']?>);">
                    <div class="media-btn" id="input-cover">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="image" class="media-input d-none" id="file-input-cover" data-preview="media-select">
                <input type="hidden" name="image-url" value="">
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Listing['featured']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Featured');?></label>
                </div>
            </div>
            <button type="submit" class="btn btn-theme btn-lg btn-block"><?php echo __('Save Changes');?></button>
        </div>
    </div>
</form>
<?php require PATH . '/view/common/footer.php';?>