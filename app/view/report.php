<?php require PATH . '/view/common/header.php'; ?>
<div class="container py-md-4">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_action" value="save">
        <input type="hidden" name="_token" value="<?php echo $Token?>">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Report');?>:</label>
            <div class="title text-primary">
                <?php echo $Reports[$Listing['report_id']];?>
            </div>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Reported by');?>:</label>
            <div class="">
                	<a href="<?php echo APP . '/profile/' . $Listing['username']; ?>" target="_blank"><?php echo $Listing['username'];?></a>
            </div>
    	</div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Description');?>:</label>
            <div class="">
                <?php echo $Listing['body'];?>
            </div>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Content');?>:</label>
            <div class="title text-primary">
            	<div style="float:left;"><?php echo $Listing['title'];?></div> <div style="float:left;margin-top:1px;margin-left:5px;"><a href="<?php echo $Listing['url']; ?>" target="_blank">(Link)</a></div>
            </div>
				<br /><br />
            <?php if($Listing['type'] == 'movie') { ?> 
            <div class="text-muted text-12"><?php echo __('Movie');?></div>
            <?php } elseif($Listing['type'] == 'serie') { ?>
            <div class="text-muted text-12"><?php echo __('Serie');?></div>
            <?php } ?>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Release Date');?>:</label>
            <div class="">
                <?php echo dating($Listing['created']);?>
            </div>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Status');?>:</label>
            <div class="switch-container">
                <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Listing['status']=='1' || !$Listing['status']) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Solved');?></label>
            </div>
        </div>
        <button class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
    </form>
</div>
<?php require PATH . '/view/common/footer.php'; ?>
