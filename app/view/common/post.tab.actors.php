<div class="mb-3">
    <button type="button" class="btn btn-purple px-md-5" data-toggle="modal" data-target="#m" data-remote="<?php echo DASHBOARD.'/modal/add.actor';?>"><?php echo __('Add Actor');?></button>
</div>
<!-- actors -->
<div class="actors-accordion" id="accordionVideo" data-id="<?php echo $Listing['id'];?>">
    <?php foreach ($Actors as $Actor) { ?>
    <!-- actor -->
    <div class="card card-list card-actor" data-id="<?php echo $Actor['id'];?>" data-actor="<?php echo $Actor['api_id'];?>">
        <input type="hidden" name="actor[<?php echo $Actor['id'];?>][id]" value="<?php echo $Actor['id'];?>">
        <input type="hidden" name="actor[<?php echo $Actor['id'];?>][actor_id]" value="<?php echo $Actor['actor_id'];?>">
        <input type="hidden" class="sortable-input" name="actor[<?php echo $Actor['id'];?>][sortable]" value="<?php echo $Actor['sortable'];?>">
        <div class="card-header" id="h-<?php echo $Actor['id'];?>">
            <div class="sortable-move">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#sort';?>" />
                </svg>
            </div>
            <div class="media media-actor w-sm-thumb lazy" data-src="<?php echo UPLOAD.'/actor/thumb-'.$Actor['image'];?>"></div>
            <div class="name">
                <div>
                    <?php echo $Actor['name'];?>
                </div>
                <input type="text" name="actor[<?php echo $Actor['id'];?>][character_name]" class="form-control form-control-sm form-transparent" value="<?php echo $Actor['character_name'];?>" placeholder="<?php echo __('Character');?>">
            </div>
            <button type="button" class="btn-remove remove-actor confirm" data-ajax="<?php echo $Actor['id'];?>" data-id="<?php echo $Actor['id'];?>">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                </svg>
            </button>
        </div>
    </div>
    <!-- actor -->
    <?php } ?>
</div> 
<!-- tmpl --> 
<script id="card-actor" type="text/x-jquery-tmpl">
<div class="card card-list card-actor" data-id="${id}" data-actor="${api_id}">
    <input type="hidden" class="sortable-input" name="actor[${id}][sortable]" value="${sortable}">
    <div class="card-header">
        <div class="sortable-move">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#sort';?>" />
            </svg>
        </div>
        <div class="media media-actor w-sm-thumb lazy" data-src="${image}"></div>
        <div class="name">
            <div>${name}</div>
            <input type="text" name="actor[${id}][character_name]" class="form-control form-control-sm form-transparent" value="${character_name}" placeholder="<?php echo __('Character');?>">
            <input type="hidden" name="actor[${id}][actor_id]" value="${actor_id}">
            <input type="hidden" name="actor[${id}][name]" value="${name}">
            <input type="hidden" name="actor[${id}][image]" value="${image}">
            <input type="hidden" name="actor[${id}][biography]" value="${biography}">
            <input type="hidden" name="actor[${id}][gender]" value="${gender}">
            <input type="hidden" name="actor[${id}][place_of_birth]" value="${place_of_birth}">
            <input type="hidden" name="actor[${id}][deathday]" value="${deathday}">
            <input type="hidden" name="actor[${id}][api_id]" value="${api_id}">
            <input type="hidden" name="actor[${id}][imdb_id]" value="${imdb_id}">
        </div>
        <button type="button" class="btn-remove remove-actor" data-id="${id}">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
            </svg>
        </button>
    </div>
</div>
</script>