
                <?php foreach ($Discussions as $Discussion) { ?>
                <div class="list-forum">
                    <a href="<?php echo profile($Discussion['id'],$Discussion['username']);?>" class="list-avatar">
                        <?php echo gravatar($Discussion['id'],$Discussion['avatar'],$Discussion['name'],'avatar');?>
                    </a>
                    <div class="flex-fill">
                        <div class="list-footer">
                            <a href="<?php echo profile($Discussion['id'],$Discussion['username']);?>" class="user">
                                <?php echo $Discussion['username'];?></a>, <?php echo __('by');?>
                            <?php echo timeago($Discussion['created']);?> <?php echo __('opened');?>
                        </div>
                        <a href="<?php echo APP.'/discussion/'.$Discussion['title']. '-' .$Discussion['id'];?>">
                            <div class="name">
                                <?php echo $Discussion['title'];?>
                            </div>
                            <div class="desc">
                                <?php echo wordlimit($Discussion['body']);?>
                            </div>
                        </a>
                    </div>
                    <div class="list-forum-comment">
                        <span class="count"><?php echo $Discussion['replies'];?></span>
                        <span class="text"><?php echo __('Reply');?></span>
                    </div>
                </div>
                <?php } ?>
