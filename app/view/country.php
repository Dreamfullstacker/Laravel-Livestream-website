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
            <label class="custom-label"><?php echo __('Language Code');?></label>
            <input type="text" name="language" class="form-control" placeholder="<?php echo __('Language Code');?>" value="<?php echo $Listing['language'];?>" maxlength="500" autofocus="true">
        </div> 
        <button class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
    </form>
</div> 
<?php require PATH . '/view/common/footer.php'; ?>