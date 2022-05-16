<?php require PATH . '/view/common/header.php';?>
<form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
    <input type="hidden" name="_ACTION" value="save">
    <input type="hidden" name="_FORMTOKEN" value="<?php echo $Token; ?>">
    <div class="d-flex">
        <div class="flex-fill">
            <div class="form-toolbar">
                <div class="nav-active-border b-primary bottom">
                    <ul class="nav" id="myTab" role="tablist">
                        <?php 
                    $i = 0;
                    foreach ($TabNav as $key => $value) { 
                    ?>
                        <li>
                            <a class="nav-link <?php if($i == 0) { echo 'active'; } ?>" id="<?php echo $key;?>-tab" data-toggle="tab" href="#<?php echo $key;?>" role="tab" aria-controls="<?php echo $key;?>" aria-selected="<?php if($i == 0) { echo 'true'; } else { echo 'false';} ?>">
                                <?php echo $value;?></a>
                        </li>
                        <?php $i++;} ?>
                        <li>
                            <a class="nav-link <?php if($i == 0) { echo 'active'; } ?>" id="pwa-tab" data-toggle="tab" href="#pwa" role="tab" aria-controls="pwa" aria-selected="<?php if($i == 0) { echo 'true'; } else { echo 'false';} ?>">
                                pwa</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <?php 
                    $i = 0;
                    foreach ($TabNav as $key => $value) { 
                    ?>
                <div class="tab-pane <?php if($i == 0) { echo 'active'; } ?>" id="<?php echo Input::seo($key);?>" role="tabpanel" aria-labelledby="<?php echo Input::seo($key);?>-tab">
                    <?php include PATH.'/view/common/settings.'.Input::seo($key).'.php';?>
                </div>
                <?php $i++; } ?>
                <div class="tab-pane <?php if($i == 0) { echo 'active'; } ?>" id="pwa" role="tabpanel" aria-labelledby="pwa-tab">
                    <?php include PATH.'/view/common/settings.pwa.php';?>
                </div>
            </div>
            <button type="submit" class="btn btn-theme btn-lg px-5 mt-3"><?php echo __('Save Changes');?></button>
        </div>
    </div>
</form> 
<?php require PATH . '/view/common/footer.php';?>