<div class="form-group">
    <label class="custom-label">
        <?php echo __('Name');?></label>
    <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" required="true">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Gender');?></label>
            <select name="gender" class="custom-select">
                <option value="">
                    <?php echo __('Gender');?>
                </option>
                <option value="2" <?php if($Listing['gender']=='2' ) echo 'selected=""' ;?>>
                    <?php echo __('Male');?>
                </option>
                <option value="1" <?php if($Listing['gender']=='1' ) echo 'selected=""' ;?>>
                    <?php echo __('Female');?>
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Birthday');?></label>
            <input type="text" name="data[birthday]" class="datepicker-form form-control" placeholder="<?php echo __('Birthday');?>" value="<?php echo $Data['birthday'];?>">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="custom-label">
        <?php echo __('Biography');?></label>
    <textarea name="biography" class="form-control" placeholder="<?php echo __('Biography');?>"><?php echo $Listing['biography'];?></textarea>
</div>
<div class="row mt-4">
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Facebook</label>
            <input type="text" name="data[social][facebook]" class="form-control" placeholder="Facebook" value="<?php echo $Data['social']['facebook'];?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Twitter</label>
            <input type="text" name="data[social][twitter]" class="form-control" placeholder="Twitter" value="<?php echo $Data['social']['twitter'];?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Instagram</label>
            <input type="text" name="data[social][instagram]" class="form-control" placeholder="Instagram" value="<?php echo $Data['social']['instagram'];?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label">Youtube</label>
            <input type="text" name="data[social][youtube]" class="form-control" placeholder="Instagram" value="<?php echo $Data['social']['youtube'];?>">
        </div>
    </div>
</div>
<div class="alert bg-warning-lt text-12 mt-3 mb-1">
    <?php echo __('Enter your username in social media accounts');?>
</div>