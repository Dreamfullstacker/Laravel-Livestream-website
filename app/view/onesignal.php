<?php require PATH . '/view/common/header.php';?>
<?php if(!get($Settings,'data.onesignal_id','api') || !get($Settings,'data.onesignal_key','api')) { ?>
<div class="alert bg-warning-lt text-12 mt-3 mb-1">
    <?php echo __('You need to enter the api keys from the settings');?>
</div>
<?php } else { ?>
<div class="container py-md-5">
    <form method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="_ACTION" value="send">
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Title');?></label>
            <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Title');?>">
        </div>
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Link');?></label>
            <input type="text" name="url" class="form-control" placeholder="https://">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="custom-label">
                        <?php echo __('Image');?></label>
                    <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="customFileLang">
                        <label class="custom-file-label" for="customFileLang" data-browse="<?php echo __('Select Image');?>">
                            <?php echo __('Select Image');?></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="custom-label">
                        <?php echo __('Upload from Link');?></label>
                    <input type="text" name="image-url" class="form-control" placeholder="https://">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Description');?></label>
            <textarea name="message" class="form-control" placeholder="<?php echo __('Description');?>"></textarea>
        </div>
        <button type="submit" class="btn btn-theme btn-lg px-5">
            <?php echo __('Submit');?></button>
    </form>
</div>
<?php } ?>
<?php require PATH . '/view/common/footer.php';?>