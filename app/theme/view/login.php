<style>
.maintainence {
	display: none !important;
}
</style>
<?php require PATH . '/theme/view/common/header.php';?>
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6 col-lg-6 col-xl-6 py-3 py-md-5">
            <form method="post" class="py-5" autocomplete="off"> 
                <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
                <input type="hidden" name="_ACTION" value="login">
                <div class="form-group">
                    <label class="form-control-label"><?php echo __('Email');?></label>
                    <input type="email" name="email" class="form-control" id="input-email" placeholder="<?php echo __('Email');?>" value="<?php echo Input::cleaner($_POST['email']);?>" required="true" autocomplete="off">
                </div>
                <div class="form-group mb-0">
                    <label class="form-control-label"><?php echo __('Password');?></label>
                    <input type="password" name="password" class="form-control" id="input-password" placeholder="<?php echo __('Password');?>" required="true" autocomplete="off">
                    <a href="<?php echo APP.'/forgot-password';?>" class="d-inline-block mt-2 text-12"><?php echo __('Forgot password');?></a>
                </div> 
                <div class="my-3">
                    <button type="submit" class="btn btn-block btn-theme btn-lg"><?php echo __('Login');?></button>
                </div>
                <!-- Links -->
                <div class="text-center"><?php echo __('Don\'t have an account ?');?>
                    <a href="<?php echo APP.'/register';?>" class="text-white"><?php echo __('Register');?></a>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php require PATH . '/theme/view/common/footer.php';?>
