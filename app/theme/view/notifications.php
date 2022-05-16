<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active"><a href="<?php echo APP.'/notifications';?>"><?php echo __('Notifications');?></a></li>
        </ol>
    </nav>
    <div class="mb-4">
        <div class="text-24 text-white font-weight-bold"><?php echo __('Notifications');?></div>
    </div>
    <?php foreach ($Notifications as $Notification) { ?>
    <?php 
    if($Notification['status'] != 1) {
        $this->db->update('notifications')->where('id',$Notification['id'])->set(array("status" => 1));
    } 
    ?>
    <div class="notification">
        <?php  
                if($Notification['type'] == 'episode') {
                    $Icon = 'popcorn';
                    $Color  = 'bg-purple';
                } elseif($Notification['type'] == 'comment') {
                    $Icon   = 'comment';
                    $Color  = 'bg-primary';
                }  elseif($Notification['type'] == 'discussion') {
                    $Icon   = 'discussion';
                    $Color  = 'bg-info';
                } 
            ?>
        <?php $NotificationData = json_decode($Notification['data'], true); ?>
        <div class="notification-icon <?php echo $Color;?>">
            <svg>
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$Icon;?>" />
            </svg>
        </div>
        <div class="flex-fill">
            <a href="<?php echo $NotificationData['link']?>">
                <?php echo $NotificationData['text']?></a>
            <div class="date">
                <?php echo timeago($Notification['created']);?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>