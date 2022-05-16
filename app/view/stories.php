<?php require PATH . '/view/common/header.php';?>
<div class="toolbar">
    <a href="<?php echo APP.'/admin/'.$Config['page'];?>" class="btn btn-filter">
        <svg class="icon">
            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#add';?>" />
        </svg>
    </a>
    <button class="btn btn-filter" data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="filter">
        <svg class="icon">
            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#filter';?>" />
        </svg>
    </button>
    <form class="flex-fill" method="post">
        <input type="text" name="search" class="form-control" placeholder="<?php echo __('Search');?> .." value="<?php echo $Filter['search'];?>" required>
    </form>
</div>
<div class="collapse <?php if($Filter['_ACTION'] == 'filter') echo 'show';?>" id="filter">
    <form class="flex-fill" method="post">
        <input type="hidden" name="_ACTION" value="filter">
        <div class="row align-items-center">
            <div class="col-md-3">
                <select name="sortable" class="custom-select">
                    <option value="">
                        <?php echo __('Sorting');?>
                    </option>
                    <option value="DESC" <?php if($Filter['sortable']=='DESC' ) echo 'selected=""' ;?>>
                        <?php echo __('Newest');?>
                    </option>
                    <option value="ASC" <?php if($Filter['sortable']=='ASC' ) echo 'selected=""' ;?>>
                        <?php echo __('Oldest');?>
                    </option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-block btn-theme">
                    <?php echo __('Apply');?></button>
            </div>
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <div class="switch-container mr-3">
                        <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Filter['featured']==1) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Fixed');?></label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-theme table-row v-middle">
        <thead class="text-muted">
            <tr>
                <th width="80"></th>
                <th><?php echo __('Story');?></th> 
                <th class="text-right"></th>
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
                    <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['id'];?>" class="text-color d-flex align-items-center"> 
                        <div class="media w-thumb lazy" data-src="<?php echo UPLOAD.'/story/'.$Listing['image'];?>"></div>
                        <div class="ml-3">
                            <div class="title">
                                <?php echo $Listing['title'];?>
                                <?php if($Listing['featured'] == '1') { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Fixed');?></span>
                                <?php } ?>
                            </div> 
                                <div class="text-muted text-12"><?php echo $Listing['subtitle'];?></div> 
                        </div>
                    </a>
                </td>
                <td class="no-wrap table-link">
                    <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['id'];?>">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#edit';?>" />
                        </svg>
                    </a>
                    <a href='<?php echo APP.'/admin/'.$Config['nav'].'?submit={"_ACTION":"delete","id":"'.$Listing['id'].'"}'?>' class="confirm">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                        </svg>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $Pagination;?>
<div class="text-muted text-12">
    <?php if($TotalRecord == 0) { ?>
    <?php echo __('No content found');?>
    <?php } else { ?>
    <?php echo $TotalRecord;?>
    <?php echo __('contains content');?>
    <?php } ?>
</div>
<?php require PATH . '/view/common/footer.php';?>