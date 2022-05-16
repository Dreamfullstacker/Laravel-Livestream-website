<?php require PATH . '/view/common/header.php'; ?>
<form method="post" enctype="multipart/form-data">
    <div class="d-md-flex">
        <div class="flex-fill">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token?>">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Related content');?></label>
                <select name="content_id" class="form-control selectize-query" data-placeholder="<?php echo __('Movie or TV Series Name');?>" data-ajax="posts">
                </select>
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Title');?></label>
                <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Title');?>" value="<?php echo $Listing['title'];?>" maxlength="255">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Sub Title');?></label>
                <input type="text" name="subtitle" class="form-control" placeholder="<?php echo __('Sub Title');?>" value="<?php echo $Listing['subtitle'];?>" maxlength="500">
            </div>
            <div class="form-group">
                <label class="custom-label">Embed</label>
                <input type="text" name="embed" class="form-control" placeholder="Embed" value="<?php echo $Listing['embed'];?>">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Custom Link');?></label>
                <input type="text" name="link" class="form-control" placeholder="https://" value="<?php echo $Listing['link'];?>" maxlength="500">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Color');?></label>
                <input type="text" name="color" class="form-control colorpicker" placeholder="<?php echo __('Color');?>" value="<?php echo $Listing['color'];?>">
            </div>
        </div>
        <div class="app-aside-right">
            <div class="form-group">
                <div class="media-select media" style="background-image: url(<?php if($Listing['image']) echo UPLOAD.'/story/'.$Listing['image']?>);">
                    <div class="media-btn" id="input-cover">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="image" class="media-input d-none" id="file-input-cover" data-preview="media-select">
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Listing['featured']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Fixed');?></label>
                </div>
            </div>
            <button class="btn btn-theme btn-lg btn-block"><?php echo __('Save Changes');?></button>
        </div>
    </div>
</form>
<?php require PATH . '/view/common/footer.php'; ?>