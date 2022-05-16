<?php require PATH . '/view/common/header.php';?>
<div class="container py-md-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['movies'];?></div>
                        <div class="text"><?php echo __('Movies');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['series'];?></div> 
                        <div class="text"><?php echo __('Series');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['episodes'];?></div> 
                        <div class="text"><?php echo __('Episodes');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['users'];?></div> 
                        <div class="text"><?php echo __('Users');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['actors'];?></div> 
                        <div class="text"><?php echo __('Actors');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['discussions'];?></div>
                        <div class="text"><?php echo __('Discussions');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <div class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['comments'];?></div>
                        <div class="text"><?php echo __('Comments');?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <a href="" class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['reports'];?></div> 
                        <div class="text"><?php echo __('Reports');?></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic">
                <a href="" class="card-body">
                    <svg>
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#analytics';?>" />
                    </svg>
                    <div>
                        <div class="count"><?php echo $Total['requests'];?></div> 
                        <div class="text"><?php echo __('Requests');?></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-theme table-row v-middle">
                    <thead class="text-muted">
                        <tr>
                            <th width="80"></th>
                            <th><?php echo __('Comment');?></th>
                            <th><?php echo __('Content');?></th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Comments as $Comment) { ?>
                        <tr class="v-middle text-color">
                            <td class="pr-0 text-muted text-12">
                                #
                                <?php echo $Comment['id'];?>
                            </td>
                            <td class="flex">
                                <a href="<?php echo APP.'/admin/comment/'.$Comment['id'];?>">
                                    <div class="title text-12">
                                        <?php echo wordlimit($Comment['comment'],40);?>
                                        <?php if($Comment['status'] != 1) { ?>
                                        <span class="badge bg-warning-lt ml-2"><?php echo __('Pending');?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </td>
                            <td class="no-wrap">
                                <?php if($Comment['type'] == 'movie') { ?>
                                <div class="text-muted text-12">
                                    <?php echo $Comment['title'];?>
                                </div>
                                <?php } elseif($Comment['type'] == 'serie') { ?>
                                <div class="title text-12">
                                    <?php echo $Comment['title'];?>
                                </div>
                                <?php } ?>
                            </td>
                            <td class="no-wrap table-link">
                                <a href="<?php echo $Comment['url'];?>" target="_blank">
                                    <i style="font-size:20px;" class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo APP.'/admin/comment/'.$Comment['id'];?>">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#edit';?>" />
                                    </svg>
                                </a>
                                <a href='<?php echo APP.'/admin/comments?submit={"_ACTION":"delete","id":"'.$Comment['id'].'"}'?>' class="confirm">
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
            <div class="table-responsive">
                <table class="table table-theme table-row v-middle">
                    <thead class="text-muted">
                        <tr>
                            <th width="80"></th> 
                            <th><?php echo __('Report');?></th>
                            <th><?php echo __('Report Date');?></th> 
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ReportsListing as $Report) { ?>
                        <tr class="v-middle text-color">
                            <td class="pr-0 text-muted text-12">
                                #
                                <?php echo $Report['id'];?>
                            </td>
                            <td class="flex">
                                <a href="<?php echo APP.'/admin/report/'.$Report['id'];?>">
                                    <div class="title text-12">
                                        <?php echo $Reports[$Report['report_id']];?>
                                        <?php if($Report['status'] != 1) { ?>
                                        <span class="badge bg-warning-lt ml-2"><?php echo __('Awaiting a solution');?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </td>
                            <td class="no-wrap">
                                <div class="text-muted text-12">
                                    <?php echo dating($Report['created']);?>
                                </div>
                            </td>
                            <td class="no-wrap table-link">
                                <a href="<?php echo $Report['url'];?>" target="_blank">
                                    <i style="font-size:20px;" class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo APP.'/admin/report/'.$Report['id'];?>">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#edit';?>" />
                                    </svg>
                                </a>
                                <a href='<?php echo APP.'/admin/reports?submit={"_ACTION":"delete","id":"'.$Report['id'].'"}'?>' class="confirm">
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
                        <?php foreach ($RequestsListing as $Requests) { ?>
                        <tr class="v-middle text-color">
                            <td class="pr-0 text-muted text-12">
                                #
                                <?php echo $Requests['id'];?>
                            </td>
                            <td class="flex">
                                    <div class="title text-12">
                                        <a href="<?php echo APP; ?>/admin/request/<?php echo $Requests['id']; ?>"><?php echo htmlspecialchars($Requests['title']);?></a>
                                    </div>
                            </td>
                            <td class="no-wrap">
                                <div class="text-muted text-12">
                                    <?php echo htmlspecialchars($Requests['type']);?>
                                </div>
                            </td>
                            <td class="no-wrap table-link">
                                <a href="#">
                                    <svg class="icon">
                                    </svg>
                                </a>
                                <a href="<?php echo htmlspecialchars($Requests['url']);?>" target="_blank">
                                    <i style="font-size:20px;" class="fas fa-eye"></i>
                                </a>
                                <a href='<?php echo APP.'/admin/requests?submit={"_ACTION":"delete","id":"'.$Requests['id'].'"}'?>' class="confirm">
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
        </div> 
    </div>
</div>
<?php require PATH . '/view/common/footer.php';?>
