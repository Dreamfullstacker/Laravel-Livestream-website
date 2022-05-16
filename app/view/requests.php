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
<div class="table-responsive">
    <table class="table table-theme table-row v-middle">
        <thead class="text-muted">
            <tr>
                <th width="80"></th>
                <th><?php echo __('Request');?></th>
                <th><?php echo __('Type');?></th>
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
                        <div class="title">
                    		<a href="<?php echo APP.'/admin/'.$Config['page'].'/'.$Listing['id'];?>">
                            	<?php echo htmlspecialchars($Listing['title']); ?><?php if ($Listing['status'] == 2) { ?><span class="badge bg-warning-lt ml-2">Request Pending</span><?php } else { ?><div class="badge bg-primary-lt ml-2">Request Filled</div><?php } ?>
                        	</a>
                        </div>
                </td>
                <td class="no-wrap"> 
                    <div class="text-muted text-12">
                        <?php echo htmlspecialchars($Listing['type']);?>
                    </div> 
                </td>
                <td class="no-wrap table-link">
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
