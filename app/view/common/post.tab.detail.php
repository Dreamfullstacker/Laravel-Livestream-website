<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Facebook</label>
            <input type="text" name="data[social][facebook]" class="form-control" placeholder="Facebook" value="<?php echo $Data['social']['facebook']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Twitter</label>
            <input type="text" name="data[social][twitter]" class="form-control" placeholder="Twitter" value="<?php echo $Data['social']['twitter']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Youtube</label>
            <input type="text" name="data[social][youtube]" class="form-control" placeholder="Youtube" value="<?php echo $Data['social']['youtube']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Instagram</label>
            <input type="text" name="data[social][instagram]" class="form-control" placeholder="Instagram" value="<?php echo $Data['social']['instagram']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="switch-container">
            <label class="switch"><input name="private" type="checkbox" value="1" <?php if($Listing['private']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Members Only');?></label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="switch-container">
            <label class="switch"><input name="politicy" type="checkbox" value="1" <?php if($Listing['politicy']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Copyright');?></label>
        </div>
    </div> 
    <div class="col-md-3">
        <div class="switch-container">
            <label class="switch"><input name="comment" type="checkbox" value="1" <?php if($Listing['comment']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Closed to comment');?></label>
        </div>
    </div> 
</div>
