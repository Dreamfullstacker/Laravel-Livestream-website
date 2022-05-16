<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content d-flex">
    <div class="flex-fill">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
                <li class="breadcrumb-item active"><a href="<?php echo APP.'/page/'.$Listing['self'];?>"><?php echo $Listing['name'];?></a></li>
            </ol>
        </nav>
        <div class="mb-4">
            <div class="text-24 text-white font-weight-bold"><?php echo $Listing['name'];?></div>
            <div class="subtext mt-3"><?php echo htmlspecialchars_decode($Listing['body']);?></div>
        </div>
    </div>

					<?php if(get($Settings,'data.showpages','theme') == 1) { } else { ?>
    <div class="app-page pt-md-4">
        <?php require PATH . '/theme/view/common/page.sidebar.php';?>
    </div>
<?php } ?>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
