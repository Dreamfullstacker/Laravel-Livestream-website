<?php 

$Story = $this->db->from(null,'
    SELECT 
    stories.id,
    stories.title,
    stories.subtitle,
    stories.embed,
    stories.content_id,
    posts.title as p_title,
    posts.self as p_self,
    posts.type as p_type,
    posts.image
    FROM `stories` 
    LEFT JOIN posts ON posts.id = stories.content_id  
    WHERE stories.id = "'.Input::cleaner($_GET['id']).'"')
    ->first();
?>
<div class="modal-content">
    <div class="modal-body p-4">
        <div class="embed-responsive embed-responsive-16by9 rounded">
            <iframe class="embed-responsive-item" src="<?php echo $Story['embed'];?>" allowfullscreen></iframe>
        </div>
        <?php if($Story['content_id']) { ?>
        <div class="mini-post">
            <div class="post-content">
                <div class="cover">
                    <div class="media media-cover" data-src="<?php echo UPLOAD.'/cover/thumb-'.$Story['image'];?>"></div>
                </div>
                <div class="flex-fill">
                    <div class="name">
                        <?php echo $Story['p_title'];?>
                    </div>
                    <div class="category">
                        <?php echo ($Story['p_type'] == 'movie') ? 'Film' : 'Dizi';?>
                    </div>
                    <a href="<?php echo post($Story['content_id'],$Story['p_self'],$Story['p_type']);?>" class="btn btn-theme"><?php echo __('Watch Now');?></a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>