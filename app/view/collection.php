<?php require PATH . '/view/common/header.php';?>
<form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
    
    <div class="d-md-flex">
        <div class="flex-fill">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_FORMTOKEN" value="<?php echo $Token; ?>">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Name');?></label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" required="true" value="<?php echo $Listing['name'];?>">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Color');?></label>
                <input type="text" name="color" class="form-control colorpicker" placeholder="<?php echo __('Color');?>" value="<?php echo $Listing['color'];?>">
            </div>
			<div class="form-group">
                <label class="custom-label"><?php echo __('Background');?></label>
                <input type="url" name="background" class="form-control form-control-lg" placeholder="<?php echo __('Background URL');?>" value="<?php echo $Listing['background'];?>">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-purple px-md-5" data-toggle="modal" data-target="#m" data-remote="<?php echo APP.'/admin/modal/add.collection';?>"><?php echo __('Add Movies or TV Shows');?></button>
            </div>
            <!-- collections -->
            <div class="collection-accordion">
                <?php foreach ($Collections as $Collection) { ?>
                <!-- collection -->
                <div class="card card-list card-collection" data-id="<?php echo $Collection['id'];?>" data-actor="<?php echo $Collection['api_id'];?>">
                    <input type="hidden" name="collection[<?php echo $Collection['id'];?>][id]" value="<?php echo $Collection['id'];?>">
                    <input type="hidden" name="collection[<?php echo $Collection['id'];?>][content_id]" value="<?php echo $Collection['actor_id'];?>">
                    <input type="hidden" class="sortable-input" name="collection[<?php echo $Collection['id'];?>][sortable]" value="<?php echo $Collection['sortable'];?>">
                    <div class="card-header">
                        <div class="media media-cover w-sm-thumb lazy" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Collection['image'];?>"></div>
                        <div class="name">
                            <div>
                                <?php echo $Collection['title'];?>
                            </div>
                            <div class="text-muted text-12">
                                <?php if($Collection['type'] == 'movie') { ?>
                                    <div><?php echo __('Movie');?></div>
                                <?php } elseif($Collection['type'] == 'serie') { ?>
                                    <div><?php echo __('Serie');?></div>
                                <?php } ?> 
                            </div>
                        </div>
                        <button type="button" class="btn-remove remove-collection confirm" data-ajax="<?php echo $Collection['id'];?>" data-id="<?php echo $Collection['id'];?>">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- collection -->
                <?php } ?>
            </div>
            <!-- collections -->
        </div>
        <div class="app-aside-right">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Privacy');?></label>
                <select name="privacy" class="custom-select">
                    <option value=""><?php echo __('Privacy');?></option>
                    <option value="1" <?php if($Listing['privacy'] == '1') echo 'selected=""';?>><?php echo __('Open to everyone');?></option>
                    <option value="2" <?php if($Listing['privacy'] == '2') echo 'selected=""';?>><?php echo __('Only me');?></option>
                </select>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Listing['featured']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Featured');?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="featuredplaylist" type="checkbox" value="1" <?php if($Listing['featuredplaylist']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Featured Playlist');?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="service" type="checkbox" value="1" <?php if($Listing['service']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Services');?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="featuredservice" type="checkbox" value="1" <?php if($Listing['featuredservice']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Featured Service');?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="playlist" type="checkbox" value="1" <?php if($Listing['playlist']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Playlist');?></label>
                </div>
            </div>
            <button type="submit" class="btn btn-theme btn-lg btn-block"><?php echo __('Save Changes');?></button>
        </div>
    </div>
</form>
<script id="card-collection" type="text/x-jquery-tmpl">
    <div class="card card-list card-collection" data-id="${id}" data-collection="${id}">
    <input type="hidden" class="sortable-input" name="collection[${id}][sortable]" value="${sortable}"> 
    <div class="card-header"> 
        <div class="media media-cover w-sm-thumb lazy" data-src="${image}"></div>
        <div class="name">
            <div>${name}</div> 
            <div class="text-muted text-12">${type_name}</div>
            <input type="hidden" name="collection[${id}][content_id]" value="${content_id}">
            <input type="hidden" name="collection[${id}][type]" value="${type}">
        </div>
        <button type="button" class="btn-remove remove-collection" data-id="${id}">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
            </svg>
        </button>
    </div>
</div>
</script>
<?php require PATH . '/view/common/footer.php';?>
