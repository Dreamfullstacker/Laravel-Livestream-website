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
            <label class="custom-label"><?php echo __('Title');?></label> 
            <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Title');?>" value="<?php echo $Listing['title'];?>">
        </div>
        <div class="form-group">
            <label class="custom-label"><?php echo __('Description');?></label>
            <textarea name="body" class="form-control" placeholder="<?php echo __('Description');?>"><?php echo $Listing['body'];?></textarea>
        </div>
        <?php if($Listing['content_id']) { ?> 
        <div class="form-group">
            <label class="custom-label"><?php echo __('Content');?></label>
            <?php if($Listing['type'] == 'movie') { ?> 
            <div class="title text-primary"><?php echo $Listing['title'];?></div>
            <div class="text-muted text-12"><?php echo __('Movie');?></div>
            <?php } elseif($Listing['type'] == 'serie') { ?>
            <div class="title text-primary"><?php echo $Listing['title'];?></div>
            <div class="text-muted text-12"><?php echo __('Serie');?></div>
            <?php } ?>
        </div>
        <?php } ?>
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