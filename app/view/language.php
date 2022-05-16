<?php require PATH . '/view/common/header.php'; ?>
<div class="container py-md-4">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_ACTION" value="save">
        <input type="hidden" name="_TOKEN" value="<?php echo $Token?>">
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Name');?></label>
            <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" maxlength="255" autofocus="true">
        </div>
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Short Code');?></label>
            <input type="text" name="short_name" class="form-control" placeholder="<?php echo __('Short Code');?>" value="<?php echo $Listing['short_name'];?>">
        </div>
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Language Code');?></label>
            <input type="text" name="language_code" class="form-control" placeholder="<?php echo __('Language Code');?>" value="<?php echo $Listing['language_code'];?>">
        </div>
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Text Direction');?></label>
            <input type="text" name="text_direction" class="form-control" placeholder="<?php echo __('Text Direction');?>" value="<?php echo $Listing['text_direction'];?>">
        </div>
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Currency');?></label>
            <input type="text" name="currency" class="form-control" placeholder="<?php echo __('Currency');?>" value="<?php echo $Listing['currency'];?>">
        </div>
        <button type="submit" class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
        <hr>
        <?php foreach ($Lang as $key => $value) { ?>
        <div class="form-group">
            <label class="custom-label">
                <?php echo $key;?></label>
            <input type="text" name="lang[<?php echo $key;?>]" class="form-control" placeholder="<?php echo __('Language');?>" value="<?php echo $value;?>">
        </div>
        <?php } ?>
    </form>
</div>
<?php require PATH . '/view/common/footer.php'; ?>