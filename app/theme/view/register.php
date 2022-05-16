<?php require PATH . '/theme/view/common/header.php';?>
<div class="flex-fill">
    <div class="auth auth-login">
        <form method="post" autocomplete="off" class="form-content">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
            <input type="hidden" name="_ACTION" value="register">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Name');?></label>
                <input type="text" name="name" class="form-control" placeholder="<?php echo __('Name');?>" required="true" value="<?php echo Input::cleaner($_POST['name']);?>">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Username');?></label>
                <input type="text" name="username" class="form-control" placeholder="<?php echo __('Username');?>" required="true" value="<?php echo Input::cleaner($_POST['username']);?>">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Email');?></label>
                <input type="email" name="email" class="form-control" placeholder="<?php echo __('Email');?>" required="true" value="<?php echo Input::cleaner($_POST['email']);?>">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Password');?></label>
                <input type="password" name="password" class="form-control" placeholder="<?php echo __('Password');?>" required="true">
            </div>
        	<center><div class="h-captcha" data-sitekey="17c52e92-569e-44b2-8bcf-34c6f624defd"></div></center>
            <button type="submit" class="btn btn-block btn-theme btn-lg"><?php echo __('Register');?></button>
        </form>
        <div class="text-center my-3"><?php echo __('I have a registered account');?> <a href="<?php echo APP.'/login';?>" class="text-white"><?php echo __('Login');?></a></div>
    </div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
