<div class="form-group">
    <label class="custom-label"><?php echo __('Name');?></label>
    <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" required="true" value="<?php echo $Listing['title'];?>">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Second Name');?></label>
    <input type="text" name="title_sub" class="form-control" placeholder="<?php echo __('Second Name');?>" value="<?php echo $Listing['title_sub'];?>">
<div class="alert bg-warning-lt text-12 mt-2"><?php echo __('Second Name is used for the translation of the content into your language.');?></div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Categories');?></label>
    <select name="category[]" class="form-control selectize-single" data-placeholder="<?php echo __('Categories');?>" multiple required="true">
        <?php foreach ($Categories as $Category) { ?>
        <option value="<?php echo $Category['id'];?>" <?php if(in_array($Category['id'], $SelectCategories)) echo ' selected=""' ;?>>
            <?php echo $Category['name'];?>
        </option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Overview');?></label>
    <textarea name="description" class="form-control" placeholder="<?php echo __('Overview');?>"><?php echo $Listing['description']; ?></textarea>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Country');?></label>
            <select name="country" class="custom-select">
                <option value=""><?php echo __('Country');?></option>
                <?php foreach ($Countries as $Country) { ?>
                <option value="<?php echo $Country['id'];?>" <?php if($Listing['country']==$Country['id']) echo 'selected="true"' ;?> data-language="<?php echo $Country['language'];?>">
                    <?php echo $Country['name'];?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Imdb');?></label>
            <input type="text" name="imdb" class="form-control" placeholder="IMDB Puanı" value="<?php echo $Listing['imdb']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Release Date');?></label>
            <input type="text" name="create_year" class="form-control" placeholder="<?php echo __('Release Date');?>" value="<?php echo $Listing['create_year']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('End Date');?></label>
            <input type="text" name="end_year" class="form-control" placeholder="<?php echo __('End Date');?>" value="<?php echo $Listing['end_year']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Series Status');?></label>
            <input type="text" name="series_status" class="form-control" placeholder="<?php echo __('Series Status');?>" value="<?php echo $Listing['series_status']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Duration');?></label>
            <input type="text" name="duration" class="form-control" placeholder="<?php echo __('Duration');?>" value="<?php echo $Listing['duration']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="custom-label"><?php echo __('MPAA');?></label>
            <input type="text" name="mpaa" class="form-control" placeholder="<?php echo __('MPAA');?>" value="<?php echo $Listing['mpaa']; ?>">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Trailer');?></label>
    <input type="text" name="trailer" class="form-control" placeholder="<?php echo __('Trailer');?>" value="<?php echo $Listing['trailer']; ?>">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Tags');?></label>
    <textarea name="data[tags]" class="form-control" placeholder="<?php echo __('Tags');?>"><?php echo $Data['tags'];?></textarea>
</div> 
