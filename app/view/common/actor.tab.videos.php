<div class="mb-3">
    <button type="button" class="btn btn-purple px-md-5" data-toggle="modal" data-target="#m" data-remote="<?php echo APP.'/admin/modal/add.content';?>"><?php echo __('Add Movies or TV Shows');?></button>
</div>
<!-- videos -->
<div class="videos-accordion">
    <?php foreach ($Videos as $Video) { ?>
    <!-- video -->
    <div class="card card-list card-actor" data-id="<?php echo $Video['id'];?>" data-actor="<?php echo $Video['api_id'];?>">
        <input type="hidden" name="video[<?php echo $Video['id'];?>][id]" value="<?php echo $Video['id'];?>">
        <input type="hidden" name="video[<?php echo $Video['id'];?>][content_id]" value="<?php echo $Video['actor_id'];?>">
        <input type="hidden" class="sortable-input" name="video[<?php echo $Video['id'];?>][sortable]" value="<?php echo $Video['sortable'];?>">
        <div class="card-header">
            <div class="media media-cover w-sm-thumb lazy" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Video['image'];?>"></div>
            <div class="name">
                <div>
                    <?php echo $Video['title'];?>
                </div>
                <input type="text" name="video[<?php echo $Video['id'];?>][character_name]" class="form-control form-control-sm form-transparent" value="<?php echo $Video['character_name'];?>" placeholder="<?php echo __('Character');?>">
            </div>
            <button type="button" class="btn-remove remove-actor-video confirm" data-ajax="<?php echo $Video['id'];?>" data-id="<?php echo $Video['id'];?>">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                </svg>
            </button>
        </div>
    </div>
    <!-- video -->
    <?php } ?>
</div>
<!-- videos --> 
<script id="card-video" type="text/x-jquery-tmpl">
    <div class="card card-list card-video" data-id="${id}" data-video="${id}">
    <input type="hidden" class="sortable-input" name="video[${id}][sortable]" value="${sortable}"> 
    <div class="card-header"> 
        <div class="media media-cover w-sm-thumb lazy" data-src="${image}"></div>
        <div class="name">
            <div>${name}</div>
            <input type="text" name="video[${id}][character_name]" class="form-control form-control-sm form-transparent" value="${character_name}" placeholder="<?php echo __('Character');?>">
            <input type="hidden" name="video[${id}][content_id]" value="${content_id}">
        </div>
        <button type="button" class="btn-remove remove-actor-video" data-id="${id}">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
            </svg>
        </button>
    </div>
</div>
</script>