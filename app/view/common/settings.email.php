<div class="form-group">
    <label class="custom-label"><?php echo __('Host');?></label>
    <input type="text" name="data[<?php echo $key?>][host]" value="<?php echo get($Settings,'data.host',$key);?>" class="form-control limitter" placeholder="<?php echo __('Host');?>" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Username');?></label>
    <input type="text" name="data[<?php echo $key?>][username]" value="<?php echo get($Settings,'data.username',$key);?>" class="form-control limitter" placeholder="<?php echo __('Username');?>" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Password');?></label>
    <input type="text" name="data[<?php echo $key?>][password]" value="<?php echo get($Settings,'data.password',$key);?>" class="form-control limitter" placeholder="<?php echo __('Password');?>" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Port');?></label>
    <input type="text" name="data[<?php echo $key?>][port]" value="<?php echo get($Settings,'data.port',$key);?>" class="form-control limitter" placeholder="<?php echo __('Port');?>" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Security');?></label>
    <select name="data[<?php echo $key?>][security]" class="custom-select">
    	<option value=""><?php echo __('Security');?></option>
    	<option value="tls" <?php if(get($Settings,'data.security',$key) == 'tls') echo 'selected';?>>TLS</option>
    	<option value="ssl" <?php if(get($Settings,'data.security',$key) == 'ssl') echo 'selected';?>>SSL</option>
    </select>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Mail Address for the Future of Emails');?></label>
    <input type="text" name="data[<?php echo $key?>][sendemail]" value="<?php echo get($Settings,'data.sendemail',$key);?>" class="form-control limitter" placeholder="<?php echo __('Mail Address for the Future of Emails');?>">
</div>