<div class="mb-3 ">
    <button type="button" class="btn btn-purple px-md-5 mr-4 btn-video" data-toggle="button"><?php echo __('Create');?></button>
</div>
<!-- videos -->
<div class="videos-accordion" id="accordionVideo" data-id="<?php echo $Listing['id'];?>">
    <?php foreach ($Videos as $Video) { ?>
    <!-- video -->
    <div class="card card-video" data-id="<?php echo $Video['id'];?>">
        <div class="card-header" id="h-<?php echo $Video['id'];?>">
            <div class="sortable-move">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#sort';?>" />
                </svg>
            </div>
            <div class="name" data-toggle="collapse" data-target="#c-<?php echo $Video['id'];?>" aria-expanded="false" aria-controls="c-<?php echo $Video['id'];?>">
                <div>
                    <?php echo $Video['language_name'];?>
                </div>
                <span>
                    <?php if(!$Video['name']) { echo $Video['service_name']; } else { echo $Video['name']; }?></span>
            </div>
            <button type="button" class="btn-remove remove-video" data-ajax="<?php echo $Video['id'];?>" data-id="<?php echo $Video['id'];?>">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                </svg>
            </button>
        </div>
        <div id="c-<?php echo $Video['id'];?>" class="collapse" aria-labelledby="h-<?php echo $Video['id'];?>" data-parent="#accordionVideo">
            <div class="card-body">
                <input type="hidden" name="video[<?php echo $Video['id'];?>][id]" value="<?php echo $Video['id'];?>">
                <input type="hidden" class="sortable-input" name="video[<?php echo $Video['id'];?>][sortable]" value="<?php echo $Video['sortable'];?>">
                <div class="form-group">
                    <label class="custom-label"><?php echo __('Title');?></label>
                    <input type="text" name="video[<?php echo $Video['id'];?>][name]" value="<?php echo $Video['name'];?>" class="form-control" placeholder="<?php echo __('Title');?>" data-card="<?php echo $Video['id'];?>">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="custom-label"><?php echo __('Language');?></label>
                            <select name="video[<?php echo $Video['id'];?>][language]" class="custom-select load-option" data-id="<?php echo $Video['language_id'];?>" data-type="language" data-card="<?php echo $Video['id'];?>">
                                <option value=""><?php echo __('Language');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="custom-label"><?php echo __('Service');?></label>
                            <select name="video[<?php echo $Video['id'];?>][service]" class="custom-select load-option" data-id="<?php echo $Video['service_id'];?>" data-type="service" data-card="<?php echo $Video['id'];?>">
                                <option value=""><?php echo __('Service');?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="custom-label"><?php echo __('Embed or Mp4');?></label>
                    <input type="text" name="video[<?php echo $Video['id'];?>][embed]" value="<?php echo $Video['embed'];?>" class="form-control" placeholder="<?php echo __('Embed or Mp4');?>" required="true">
                </div>
                <div class="form-group">
                    <label class="custom-label"><?php echo __('Download URL');?></label>
                    <input type="text" name="video[<?php echo $Video['id'];?>][download]" value="<?php echo $Video['download'];?>" class="form-control" placeholder="<?php echo __('Download URL');?>">
                </div>
                <div class="switch-container">
                    <label class="switch">
                        <input name="video[<?php echo $Video['id'];?>][player]" type="checkbox" value="1" <?php if($Video['player']=='1' ) echo 'checked="true"' ; ?>><span class="switch-button"></span><?php echo __('Use Video Player');?>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- video -->
    <?php } ?>
</div>
<!-- videos -->
<div class="alert bg-warning-lt text-12 mt-3 mb-1"><?php echo __('You can change the order by drag and drop');?></div>
<div class="alert bg-primary-lt text-12"><?php echo __('Video Player only works when mp4 file is entered into the embed code');?></div>
<!-- tmpl --> 
<script id="card-video" type="text/x-jquery-tmpl">
    <div class="card card-video" data-id="${id}">
    <div class="card-header" id="h-${id}">
        <div class="sortable-move">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#sort';?>" />
            </svg>
        </div>
        <div class="name" data-toggle="collapse" data-target="#c-${id}" aria-expanded="false" aria-controls="c-${id}">
            <div>${name}</div>
            <span>${languageName}</span>
        </div> 
        <button type="button" class="btn-remove remove-video" data-id="${id}">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
            </svg>
        </button>
    </div>
    <div id="c-${id}" class="collapse" aria-labelledby="h-${id}" data-parent="#accordionVideo">
        <input type="hidden" class="sortable-input" name="video[${id}][sortable]" value="">
        <div class="card-body">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Name');?></label>
                <input type="text" name="video[${id}][name]" value="${name}" class="form-control" placeholder="<?php echo __('Name');?>" data-card="${id}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Language');?></label>
                        <select name="video[${id}][language]" class="custom-select load-option" data-id="${language}" data-type="language" data-card="${id}">
                            <option value=""><?php echo __('Language');?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Service');?></label>
                        <select name="video[${id}][service]" class="custom-select load-option" data-id="${service}" data-type="service" data-card="${id}">
                            <option value=""><?php echo __('Service');?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Embed or Mp4');?></label>
                <input type="text" name="video[${id}][embed]" value="${embed}" class="form-control" placeholder="<?php echo __('Embed or Mp4');?>" required="true">
            </div>
            <div class="form-group">
                 <label class="custom-label"><?php echo __('Download URL');?></label>
                 <input type="text" name="video[<?php echo $Video['id'];?>][download]" value="<?php echo $Video['download'];?>" class="form-control" placeholder="<?php echo __('Download URL');?>">
            </div>
            <div class="switch-container">
                <label class="switch">
                    <input name="video[${id}][player]" type="checkbox" value="1" {{if player === '1'}} checked="true" {{/if}}> <span class="switch-button"></span><?php echo __('Use Video Player');?>
                </label>
            </div>
        </div>
    </div>
</div>
</script>