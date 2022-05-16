<?php require PATH . '/view/common/header.php'; ?>
<div class="container py-md-4">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_action" value="save">
        <input type="hidden" name="_token" value="<?php echo $Token?>">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Name');?></label>
            <input type="text" name="name" class="form-control form-control-lg form-control-theme" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" maxlength="255" autofocus="true">
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Type');?></label>
            <select name="type" class="custom-select" required="true">
                <option value=""><?php echo __('Type');?></option>
                <option value="language" <?php if($Listing['type'] == 'language') echo 'selected="true"';?>><?php echo __('Language');?></option>
                <option value="service" <?php if($Listing['type'] == 'service') echo 'selected="true"';?>><?php echo __('Service');?></option>
            </select>
        </div> 
        <button type="submit" class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
    </form>
</div>
<?php require PATH . '/view/common/footer.php'; ?>