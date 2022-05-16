<?php require PATH . '/theme/view/common/header.php';?>
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6 col-lg-6 col-xl-6 py-3 py-md-5">
            <form method="post" class="py-5">
                <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
                <input type="hidden" name="_ACTION" value="recovery">
                <div class="form-group">
                    <label class="form-control-label"><?php echo __('Email');?></label>
                    <input type="email" name="email" class="form-control form-control-lg" id="input-email" placeholder="<?php echo __('Email');?>" autofocus="true" required="true">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-block btn-lg btn-theme"><?php echo __('Submit');?></button>
                </div>
            </form> 
        </div>
    </div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>