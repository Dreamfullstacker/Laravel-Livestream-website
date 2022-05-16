<?php require PATH . '/view/common/header.php';?>
<form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
    <div class="d-md-flex">
        <div class="flex-fill">
            <div class="form-toolbar">
                <div class="nav-active-border b-primary bottom">
                    <ul class="nav" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="contents-tab" data-toggle="tab" href="#contents" role="tab" aria-controls="contents" aria-selected="true"><?php echo __('General');?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seasons-tab" data-toggle="tab" href="#seasons" role="tab" aria-controls="seasons" aria-selected="false"><?php echo __('Seasons');?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo APP.'/admin/episodes/'.$Listing['id'];?>" target="_blank"><?php echo __('Episodes');?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors" role="tab" aria-controls="actors" aria-selected="false"><?php echo __('Actors');?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="advanced-tab" data-toggle="tab" href="#advanced" role="tab" aria-controls="advanced" aria-selected="false"><?php echo __('Advanced Settings');?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_FORMTOKEN" value="<?php echo $Token; ?>">
            <div class="tab-content">
                <div class="tab-pane show active" id="contents" role="tabpanel" aria-labelledby="contents-tab">
                    <?php require PATH . '/view/common/post.tab.content.php';?>
                </div>
                <div class="tab-pane" id="seasons" role="tabpanel" aria-labelledby="seasons-tab">
                    <?php require PATH . '/view/common/post.tab.seasons.php';?>
                </div> 
                <div class="tab-pane" id="actors" role="tabpanel" aria-labelledby="actors-tab">
                    <?php require PATH . '/view/common/post.tab.actors.php';?>
                </div> 
                <div class="tab-pane" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
                    <?php require PATH . '/view/common/post.tab.detail.php';?>
                </div>
            </div>
        </div>
        <div class="app-aside-right">
            <div class="form-group">
                <div class="media-select media media-cover" style="background-image: url(<?php if($Listing['image']) echo UPLOAD.'/cover/'.$Listing['image']?>);">
                    <div class="media-btn" id="input-cover">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="image" class="media-input d-none" id="file-input-cover" data-preview="media-cover">
                <input type="hidden" name="image-url" value="">
            </div>
            <div class="form-group">
                <div class="media-select media media-episode" style="background-image: url(<?php if($Listing['cover']) echo UPLOAD.'/cover/'.$Listing['cover']?>);">
                    <div class="media-btn" id="input-episode">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="cover" class="media-input d-none" id="file-input-episode" data-preview="media-episode"> 
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Quality');?></label>
                <select name="quality" class="custom-select custom-select-sm" required="true">
                    <option value=""><?php echo __('Quality');?></option>
                    <?php foreach ($Qualities as $Name => $Quality) { ?>
                    <option value="<?php echo $Quality;?>" <?php if($Quality==$Listing['quality']) echo 'selected="true"' ;?>>
                        <?php echo $Quality;?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="status" type="checkbox" value="1" <?php if($Listing['status']=='1' || !$Listing['status']) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Active');?></label>
                </div>
                <div class="switch-container">
                    <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Listing['featured']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Featured');?></label>
                </div>
                <div class="switch-container">
                    <label class="switch"><input name="anime" type="checkbox" value="1" <?php if($Listing['anime']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Anime');?></label>
                </div>
            </div>
            <button type="submit" class="btn btn-theme btn-lg btn-block mb-3"><?php echo __('Save Changes');?></button> 
        </div>
    </div>
</form> 
<?php require PATH . '/view/common/footer.php';?>
