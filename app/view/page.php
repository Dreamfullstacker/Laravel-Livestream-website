<?php require PATH . '/view/common/header.php'; ?>
<div class="container py-md-4">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_ACTION" value="save">
        <input type="hidden" name="_TOKEN" value="<?php echo $Token?>">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Name');?></label>
            <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" maxlength="255" autofocus="true">
        </div>
        <div class="form-group">
            <textarea name="body" class="form-control summernote"><?php echo htmlspecialchars_decode($Listing['body']);?></textarea>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Status');?></label>
            <div class="switch-container">
                <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Listing['status']=='1' || !$Listing['status']) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Active');?></label>
            </div>
        </div>
        <button class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
    </form>
</div> 
<?php require PATH . '/view/common/footer.php'; ?>