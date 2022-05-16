<?php if ($Listing['username'] == $AuthUser['username']) { } else { ?>
<style>
#reports-tab {
	display: none;
}
</style>
<?php } ?>
<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $Listing['username'];?></li>
        </ol>
    </nav>
    <div class="app-section">
        <div class="user-profile">
            <div class="cover"></div>
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo gravatar($Listing['id'],$Listing['avatar'],$Listing['name'],'avatar');?>
                    <svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36">
                        <circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="100 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle>
                    </svg>
                </div>
                <div class="profile-content">
                    <div class="name">
                        <?php echo $Listing['name'];?>
                    </div>
                    <div class="username">
                        <?php echo $Listing['username'];?>
                    </div>
        <?php if($Data['gender']) { ?>
        <div class="username">
					<?php
						if(strpos($Data['gender'], '1') !== false){
							echo "Mulher";
						} else {
							echo "Homen";
						}
					?>
            </div>
        <?php } ?>
                    <div class="nav-social">
                        <?php foreach ($Data['social'] as $key => $value) { ?>
                        <?php if($value) { ?>
                        <a href="<?php echo 'https://www.'.$key.'.com/'.$value;?>" target="_blank" title="<?php echo $key;?>">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$key;?>" />
                            </svg>
                        </a>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="profile-tab mt-3">
                <div class="nav-active-border b-primary bottom">
                    <ul class="nav pt-0" id="myTab" role="tablist">
                        <?php 
                    $i = 0;
                    foreach ($TabNav as $key => $value) { 
                    ?>
                        <li>
                            <a class=" nav-link <?php if($i == 0) { echo 'active'; } ?>" id="<?php echo $key;?>-tab" data-toggle="tab" href="#<?php echo $key;?>" role="tab" aria-controls="<?php echo $key;?>" aria-selected="<?php if($i == 0) { echo 'true'; } else { echo 'false';} ?>">
                                <?php echo $value;?></a>
                        </li>
                        <?php $i++;} ?>
                    </ul>
                </div>
            </div>
            <div class="tab-content py-3">
                <?php 
                $i = 0;
                foreach ($TabNav as $key => $value) { 
                ?>
                <div class="tab-pane <?php if($i == 0) { echo 'active'; } ?>" id="<?php echo Input::seo($key);?>" role="tabpanel" aria-labelledby="<?php echo Input::seo($key);?>-tab">
                    <?php include PATH.'/theme/view/common/profile.'.Input::seo($key).'.php';?>
                </div>
                <?php $i++; } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var tabUrl = document.location.toString();
if (tabUrl.match('#')) {
    $('.profile-tab a[href="#' + tabUrl.split('#')[1] + '"]').tab('show');
}
$('.profile-tab a').on('shown.bs.tab', function(e) {
    window.location.hash = e.target.hash;
})
</script>
<?php require PATH . '/theme/view/common/footer.php';?>
