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
                <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Title');?>" value="<?php echo $Listing['title'];?>" autofocus="true">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Description');?></label>
<br /><?php echo __('Leave blank to use listings description or fill in to use a custom description');?>
                <textarea name="body" class="form-control" placeholder="<?php echo __('Description');?>"><?php echo $Listing['body'];?></textarea>
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Custom Link');?></label>
                <input type="text" name="link" class="form-control" placeholder="https://" value="<?php echo $Listing['link'];?>" maxlength="500">
            </div>  
        </div>
        <div class="app-aside-right">
            <div class="form-group">
<label class="custom-label"><?php echo __('Leave blank to use listings cover image or upload an image to use a custom cover image');?></label>
                <div class="media-select media-slide media" style="background-image: url(<?php if($Listing['image']) echo UPLOAD.'/slide/'.$Listing['image']?>);">
                    <div class="media-btn" id="input-cover">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="image" class="media-input d-none" id="file-input-cover" data-preview="media-select">
            </div> 
            <button class="btn btn-theme btn-lg btn-block"><?php echo __('Save Changes');?></button>
        </div>
    </div>
</form> 
<?php require PATH . '/view/common/footer.php'; ?>
