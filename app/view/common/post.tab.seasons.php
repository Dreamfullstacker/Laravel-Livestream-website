<div class="mb-3 ">
    <button type="button" class="btn btn-purple px-md-5 mr-2 add-tab" data-toggle="modal" data-target="#m" data-remote="<?php echo DASHBOARD.'/modal/season';?>"><?php echo __('Create');?></button>
</div>
<div class="seasons">
    <?php foreach ($Seasons as $Season) { ?>
    <div class="card card-season card-list" data-id="<?php echo $Season['id'];?>">
        <input type="hidden" name="season[<?php echo $Season['id'];?>][id]" value="<?php echo $Season['id'];?>">
        <input type="hidden" class="sortable-input" name="season[<?php echo $Season['id'];?>][sortable]" value="">
        <div class="card-header" id="h-<?php echo $Season['id'];?>">
            <div class="sortable-move">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#sort';?>" />
                </svg>
            </div>
            <div class="name" data-toggle="collapse" data-target="#c-<?php echo $Season['id'];?>" aria-expanded="false" aria-controls="c-<?php echo $Season['id'];?>">
                <div>
                    <?php echo __('Season').' '.$Season['name'];?></div>
            </div>
            <button type="button" class="btn-remove remove-season" data-ajax="<?php echo $Season['id'];?>" data-id="<?php echo $Season['id'];?>">
                <svg class="icon">
                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                </svg>
            </button>
        </div>
        <div id="c-<?php echo $Season['id'];?>" class="collapse" aria-labelledby="h-<?php echo $Season['id'];?>" data-parent="#accordionVideo">
            <input type="hidden" class="sortable-input" name="season[<?php echo $Season['id'];?>][sortable]" value="">
            <div class="card-body py-0">
                <div class="form-group">
                    <label class="custom-label"><?php echo __('Season');?></label>
                    <input type="text" name="season[<?php echo $Season['id'];?>][name]" value="<?php echo $Season['name'];?>" class="form-control" placeholder="Sezon" data-card="<?php echo $Season['id'];?>">
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div> 
<!-- tmpl --> 
<script id="card-season" type="text/x-jquery-tmpl">
<div class="card card-season card-list" data-id="${id}">
    <input type="hidden" class="sortable-input" name="season[${id}][sortable]" value="">
    <div class="card-header" id="h-${id}">
        <div class="sortable-move">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#sort';?>" />
            </svg>
        </div>
        <div class="name" data-toggle="collapse" data-target="#c-${id}" aria-expanded="false" aria-controls="c-${id}">
            <div>${name} <?php echo __('Season');?></div>
        </div>
        <button type="button" class="btn-remove remove-season" data-id="${id}">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
            </svg>
        </button>
    </div>
    <div id="c-${id}" class="collapse" aria-labelledby="h-${id}" data-parent="#accordionVideo">
        <input type="hidden" class="sortable-input" name="season[${id}][sortable]" value="">
        <div class="card-body py-0">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Season');?></label>
                <input type="text" name="season[${id}][name]" value="${name}" class="form-control" placeholder="<?php echo __('Season');?>" data-card="${id}">
            </div>
        </div>
    </div>
</div>
</script>