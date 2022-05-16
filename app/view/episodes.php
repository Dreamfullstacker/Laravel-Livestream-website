<?php require PATH . '/view/common/header.php';?>
<div class="toolbar">
    <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Route->params->id;?>" class="btn btn-filter">
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
                <select name="season_id" class="custom-select">
                    <option value=""><?php echo __('Season');?></option>
                    <?php foreach ($Seasons as $Season) { ?>
                    <option value="<?php echo $Season['id'];?>" <?php if($Season['id']==$Filter['season_id']) echo 'selected=""' ;?>>
                        <?php echo $Season['name'];?>
                    </option>
                    <?php } ?>
                </select>
            </div>
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
            <div class="col-md-6">
                <div class="d-flex align-items-center mt-2">
                    <div class="switch-container mr-3">
                        <label class="switch"><input name="featured" type="checkbox" value="1" <?php if($Filter['featured']==1) echo 'checked="true"' ;?>><span class="switch-button"></span>
                            <?php echo __('Featured');?></label>
                    </div>
                    <div class="switch-container">
                        <label class="switch"><input name="status" type="checkbox" value="2" <?php if($Filter['status']==2) echo 'checked="true"' ;?>><span class="switch-button"></span>
                            <?php echo __('Disabled');?></label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-theme table-row v-middle sortable">
        <thead class="text-muted">
            <tr>
                <th width="80">#</th>
                <th><?php echo __('Episode');?></th>
                <th><?php echo __('Release Date');?></th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            <?php sort($Listings); foreach ($Listings as $Listing) {  ?>
            <tr class="v-middle text-color">
                <td class="pr-0 text-muted text-12">
                    #
                    <?php echo $Listing['id'];?>
                </td>
                <td class="flex">
                    <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['content_id'].'/'.$Listing['id'];?>" class="d-flex align-items-center">
                        <div class="media media-cover-temp w-thumb lazy" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Listing['image'];?>"></div>
                        <div class="ml-3">
                            <div class="title">
                                <?php echo __('Season').' '.$Listing['season'].': '.__('Episode').' '.$Listing['name'];?>
                                <?php if($Listing['statussub'] == '2') { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Episode Disabled');?></span>
                                <?php } ?>
                                <?php if($Listing['status'] == '2') { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Show Disabled');?></span>
                                <?php } ?>
                            </div>
                            <div class="text-12 text-muted">
                                <?php echo $Listing['title'];?>
                            </div>
                        </div>
                    </a>
                </td>
                <td class="flex text-muted text-12">
                    <?php echo dating($Listing['created']);?>
                </td>
                <td class="no-wrap table-link">
                    <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['content_id'].'/'.$Listing['id'];?>">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#edit';?>" />
                        </svg>
                    </a>
                    <a href='<?php echo APP.'/admin/'.$Config['pages'].'?submit={"_ACTION":"delete","id":"'.$Listing['id'].'"}'?>' class="confirm">
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
