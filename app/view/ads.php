<?php require PATH . '/view/common/header.php';?>
<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-theme">
                <thead class="text-muted">
                    <tr>
                        <th width="80">ID</th>
                        <th><?php echo __('Advertisement');?></th>
                        <th class="text-right"><span class="d-none d-sm-block"><?php echo __('Action');?></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Listings as $Listing) { ?>
                    <tr class="v-middle text-color">
                        <td class="pr-0 text-muted text-12">
                            #
                            <?php echo $Listing['id'];?>
                        </td>
                        <td class="flex">
                            <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['id'];?>">
                                <div class="text-wide-wrap">
                                    <?php echo $Listing['name'];?>
                                    <?php if($Listing['status'] == '2') { ?>
                                    <span class="badge bg-warning-lt ml-2"><?php echo __('Disabled');?></span>
                                    <?php } ?>
                                </div>
                            </a>
                        </td>
                        <td class="no-wrap table-link">
                            <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['id'];?>">
                                <svg class="icon">
                                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#edit';?>" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($Ads['name']) { ?>
    <div class="col-md-4">
        <form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token?>">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Name');?></label>
                <input type="text" name="name" class="form-control form-control-lg" readonly="true" placeholder="<?php echo __('Name');?>" value="<?php echo $Ads['name'];?>" maxlength="255" autofocus="true">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Link');?></label>
                <input type="text" name="link" class="form-control" placeholder="<?php echo __('Link');?>" value="<?php echo $Data['link'];?>" maxlength="500" autofocus="true">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Image');?></label>
                <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="customFileLang" lang="tr">
                    <label class="custom-file-label" for="customFileLang" data-browse="<?php echo __('Select Image');?>"><?php echo __('Select Image');?></label>
                </div> 
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Code');?></label>
                <textarea name="ads_code" class="form-control" placeholder="<?php echo __('Code');?>"><?php echo $Ads['ads_code'];?></textarea>
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Advanced Settings');?></label>
                <div class="switch-container">
                    <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Ads['status']=='1' || !$Ads['status']) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Active');?></label> 
                </div>
            </div>
            <button class="btn btn-theme btn-lg btn-block"><?php echo __('Save Changes');?></button>
        </form>
    </div>
    <?php } ?>
</div>
<?php require PATH . '/view/common/footer.php';?>