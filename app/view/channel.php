<?php require PATH . '/view/common/header.php';?>
<form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
    <div class="d-md-flex">
        <div class="flex-fill">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_FORMTOKEN" value="<?php echo $Token; ?>">
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Name');?></label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" maxlength="255" autofocus="true">
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Overview');?></label>
                <textarea name="description" class="form-control" placeholder="<?php echo __('Overview');?>"><?php echo $Listing['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Embed');?></label>
                <input type="text" name="embed" class="form-control" placeholder="<?php echo __('Embed');?>" value="<?php echo $Listing['embed'];?>" maxlength="255" autofocus="true">
            </div>
            <div class="alert bg-warning-lt text-12 mt-3 mb-1">
                https://stream.example.com/player
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Facebook</label>
                        <input type="text" name="data[social][facebook]" class="form-control" placeholder="Facebook" value="<?php echo $Data['social']['facebook']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Twitter</label>
                        <input type="text" name="data[social][twitter]" class="form-control" placeholder="Twitter" value="<?php echo $Data['social']['twitter']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Youtube</label>
                        <input type="text" name="data[social][youtube]" class="form-control" placeholder="Youtube" value="<?php echo $Data['social']['youtube']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Instagram</label>
                        <input type="text" name="data[social][instagram]" class="form-control" placeholder="Instagram" value="<?php echo $Data['social']['instagram']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="switch-container">
                        <label class="switch"><input name="private" type="checkbox" value="1" <?php if($Listing['private']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                            <?php echo __('Members Only');?></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="switch-container">
                        <label class="switch"><input name="data[politicy]" type="checkbox" value="1" <?php if($Data['politicy']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                            <?php echo __('Copyright');?></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="switch-container">
                        <label class="switch"><input name="comment" type="checkbox" value="1" <?php if($Listing['comment']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                            <?php echo __('Closed to comment');?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-aside-right">
            <div class="form-group">
                <div class="media-select media media-actor" style="background-image: url(<?php if($Listing['image']) echo UPLOAD.'/channel/'.$Listing['image']?>);">
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
                    <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Listing['featured']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                        <?php echo __('Featured');?></label>
                </div>
                <div class="switch-container">
                    <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Listing['status']=='1' || !$Listing['status']) echo 'checked="true"' ;?>><span class="switch-button"></span>
                        <?php echo __('Active');?></label>
                </div>
            </div>
            <button type="submit" class="btn btn-theme btn-lg btn-block">
                <?php echo __('Save Changes');?></button>
        </div>
    </div>
</form>
<?php require PATH . '/view/common/footer.php';?>