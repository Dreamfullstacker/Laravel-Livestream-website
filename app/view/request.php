<?php require PATH . '/view/common/header.php'; ?>
<div class="container py-md-4">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_action" value="save">
        <input type="hidden" name="_token" value="<?php echo $Token?>">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Request Title');?>:</label>
            <div class="title text-primary" style="text-transform: capitalize;">
                <?php echo $Listing['title'];?>
            </div>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Type');?>:</label>
            <div class="title text-primary" style="text-transform: capitalize;">
                	<?php echo $Listing['type'];?>
            </div>
    	</div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('View on IMDb');?>:</label>
            <div class="title text-primary">
            	<a href="<?php echo $Listing['url'];?>">View</a>
            </div>
    	</div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Request Status');?>:</label>
            <div class="switch-container">
                <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Listing['status']=='1' || !$Listing['status']) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Filled');?></label>
            </div>
        </div>
        <button class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
    </form>
</div>
<?php require PATH . '/view/common/footer.php'; ?>
