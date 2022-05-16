<?php require PATH . '/view/common/header.php';?>
<div class="toolbar">
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
                <div class="d-flex align-items-center mt-2">
                    <div class="switch-container">
                        <label class="switch mr-3"><input name="spoiler" type="checkbox" value="1" <?php if($Filter['spoiler']==1) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Containing spoilers');?></label>
                        <label class="switch"><input name="status" type="checkbox" value="2" <?php if($Filter['status']==2) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Pending Approval');?></label>
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
                <th><?php echo __('User');?></th>
                <th><?php echo __('Content');?></th>
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
                        <?php echo gravatar($Listing['user_id'],$Listing['avatar'],$Listing['name'],'media w-sm-thumb lazy');?>
                        <div class="ml-3">
                            <div class="title">
                                <?php echo $Listing['name'];?>
                                <?php if($Listing['status'] != 1) { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Pending');?></span>
                                <?php } ?>
                            </div>
                            <div class="text-muted text-12">
                                <?php echo wordlimit($Listing['comment'],100);?>
                            </div>
                        </div>
                    </a>
                </td>
                <td class="no-wrap">
                    <?php if($Listing['type'] == 'movie') { ?>
                    <div class="title text-12">
                        <?php echo $Listing['title'];?>
                    </div>
                    <div class="text-muted text-12"><?php echo __('Movie');?></div>
                    <?php } elseif($Listing['type'] == 'serie') { ?>
                    <div class="title text-12">
                        <?php echo $Listing['title'];?>
                    </div>
                    <div class="text-muted text-12"><?php echo __('Serie');?></div>
                    <?php } ?>
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