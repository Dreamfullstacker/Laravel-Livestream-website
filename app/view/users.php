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
                <select name="account_type" class="custom-select">
                    <option value=""><?php echo __('Type');?></option>
                    <option value="admin" <?php if($Filter['account_type'] == 'admin') echo 'selected=""';?>><?php echo __('Admin');?></option>
                    <option value="supporter" <?php if($Filter['account_type'] == 'supporter') echo 'selected=""';?>><?php echo __('Supporter');?></option>
                    <option value="user" <?php if($Filter['account_type'] == 'user') echo 'selected=""';?>><?php echo __('User');?></option>
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
                        <label class="switch"><input name="banned" type="checkbox" value="1" <?php if($Filter['banned']==1) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Banned Members');?></label>
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
                        <?php echo gravatar($Listing['id'],$Listing['avatar'],$Listing['name'],'media w-sm-thumb lazy');?>
                        <div class="ml-3">
                            <div class="title">
                                <?php echo $Listing['name'];?>
                                <?php if($Listing['account_type'] == 'admin') { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Admin');?></span>
                                <?php } ?>
                                <?php if($Listing['banned'] == '1') { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Banned');?></span>
                                <?php } ?>
                                <?php if($Listing['chatboxban'] == '1') { ?>
                                <span class="badge bg-warning-lt ml-2"><?php echo __('Banned from Chatbox');?></span>
                                <?php } ?>
                            </div> 
                                <div class="text-muted text-12"><?php echo $Listing['username'];?></div> 
                        </div>
                    </a>
                </td>
                <td class="no-wrap table-link">
                    <a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['id'];?>">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#edit';?>" />
                        </svg>
                    </a>
                    <?php if($Listing['id'] != $AuthUser['id']) { ?>
                    <a href='<?php echo APP.'/admin/'.$Config['nav'].'?submit={"_ACTION":"delete","id":"'.$Listing['id'].'"}'?>' class="confirm">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#delete';?>" />
                        </svg>
                    </a>
                    <?php } ?>
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
