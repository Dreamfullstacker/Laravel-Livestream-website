<?php require PATH . '/view/common/header.php';?>
<?php if(!get($Settings,'data.tmdb_api','api') || !get($Settings,'data.tmdb_language','api')) { ?>
<div class="alert bg-warning-lt text-12 mt-3 mb-1">
    <?php echo __('You need to enter the api keys from the settings');?>
</div>
<?php } else { ?>
<div class="d-md-flex">
    <div class="flex-fill">
        <div class="table-responsive">
            <table class="table table-theme table-row v-middle">
                <tbody>
                    <?php foreach ($Listings as $Listing) { ?>
                    <tr class="v-middle text-color card-item" data-id="<?php echo $Listing['id'];?>">
                        <td class="flex">
                            <a href="<?php $Listing['link'];?>" target="_blank" class="d-flex align-items-center">
                                <div class="media media-cover-temp w-thumb lazy" data-src="<?php echo $Listing['image'];?>"></div>
                                <div class="ml-3">
                                    <div class="title">
                                        <?php echo $Listing['title'];?>
                                    </div>
                                    <div class="text-12 text-muted">
                                        <?php echo $Listing['link'];?>
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td class="no-wrap table-link">
                            <a href="javascript:;" class="btn-insert" data-ajax="<?php echo $Listing['id'];?>" data-type="<?php echo $Listing['type'];?>">
                                <svg class="icon">
                                    <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#add';?>" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php echo $Pagination;?>
    </div>
    <div class="app-aside-right">
        <form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
            <input type="hidden" name="_ACTION" value="filter">
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Type');?></label>
                <select name="type" class="custom-select">
                    <option value="tv" <?php if($Filter['type']=='tv' ) echo 'selected=""' ;?>>
                        <?php echo __('Serie');?>
                    </option>
                    <option value="movie" <?php if($Filter['type']=='movie' ) echo 'selected=""' ;?>>
                        <?php echo __('Movie');?>
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Search');?></label>
                <input type="text" name="q" class="form-control" placeholder="<?php echo __('Search');?> .." value="<?php echo $Filter['q'];?>">
			</div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Bulk IDs');?></label>
                <textarea  type="textarea" name="bulk_ids" class="form-control" placeholder="<?php echo __('Insert one TMDb ID per row');?>..."><?php echo $Filter['bulk_ids'];?></textarea>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Sorting');?></label>
                <select name="sort" class="custom-select">
                    <option value="release_date.desc" <?php if($Filter['sort']=='release_date.desc' ) echo 'selected=""' ;?>>
                        <?php echo __('Newest');?>
                    </option>
                    <option value="popularity.DESC" <?php if($Filter['sort']=='popularity.DESC' ) echo 'selected=""' ;?>>
                        <?php echo __('Popular');?>
                    </option>
                    <option value="vote_count.desc" <?php if($Filter['sort']=='vote_count.desc' ) echo 'selected=""' ;?>>
                        <?php echo __('Vote');?>
                    </option>
                </select>
            </div>
            <div class="switch-container">
                <label class="switch mr-3"><input name="actor" type="checkbox" value="add" <?php if($Filter['actor']=='add' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                    <?php echo __('Actors');?></label>
            </div>
            <div class="switch-container">
                <label class="switch mr-3"><input name="season" type="checkbox" value="add" <?php if($Filter['season']=='add' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                    <?php echo __('Seasons');?></label>
            </div>
            <div class="switch-container">
                <label class="switch"><input name="episode" type="checkbox" value="add" <?php if($Filter['episode']=='add' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                    <?php echo __('Episodes');?></label>
            </div>
            <button type="submit" class="btn btn-block btn-primary mt-3">
                <?php echo __('Apply');?></button>
        </form>
    </div>
</div>
<?php } ?>
<?php require PATH . '/view/common/footer.php';?>
