<?php require PATH . '/view/common/header.php'; ?>
<div class="container py-md-4">
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_action" value="save">
        <input type="hidden" name="_token" value="<?php echo $Token?>">
        <div class="form-group">
            <a href="<?php echo APP.'/admin/user/'.$Listing['user_id'];?>" class="text-color d-flex align-items-center">
                <?php echo gravatar($Listing['id'],$Listing['avatar'],$Listing['name'],'media w-sm-thumb lazy');?>
                <div class="ml-3">
                    <div class="title">
                        <?php echo $Listing['name'];?>
                    </div>
                    <div class="text-muted text-12">
                        <?php echo $Listing['username'];?>
                    </div>
                </div>
            </a>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Save Changes');?></label>
            <textarea name="comment" class="form-control" placeholder="<?php echo __('Comment');?>"><?php echo $Listing['comment'];?></textarea>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Content');?></label>
            <?php if($Listing['type'] == 'movie') { ?> 
            <div class="title text-primary"><?php echo $Listing['title'];?></div>
            <div class="text-muted text-12"><?php echo __('Movie');?></div>
            <?php } elseif($Listing['type'] == 'serie') { ?>
            <div class="title text-primary"><?php echo $Listing['title'];?></div>
            <div class="text-muted text-12"><?php echo __('Serie');?></div>
            <?php } elseif($Listing['d_title']) { ?>
            <div class="title text-primary"><?php echo $Listing['d_title'];?></div>
            <div class="text-muted text-12"><?php echo __('Discussion');?></div>
            <?php } ?>
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Status');?></label>
            <div class="switch-container">
                <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Listing['status']=='1' || !$Listing['status']) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Active');?></label>
                <label class="switch ml-4"><input name="spoiler" type="checkbox" value="1" <?php if($Listing['spoiler']=='1') echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Spoiler');?></label>
            </div>
        </div>
        <button class="btn btn-theme btn-lg px-md-5"><?php echo __('Save Changes');?></button>
    </form>
</div>
<?php require PATH . '/view/common/footer.php'; ?>