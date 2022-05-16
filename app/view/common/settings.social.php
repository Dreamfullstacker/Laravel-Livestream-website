<div class="form-group">
    <label class="custom-label">Facebook</label>
    <input type="text" name="data[<?php echo $key?>][facebook]" value="<?php echo get($Settings,'data.facebook',$key);?>" class="form-control limitter" placeholder="Facebook" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label">Twitter</label>
    <input type="text" name="data[<?php echo $key?>][twitter]" value="<?php echo get($Settings,'data.twitter',$key);?>" class="form-control limitter" placeholder="Twitter" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label">Instagram</label>
    <input type="text" name="data[<?php echo $key?>][instagram]" value="<?php echo get($Settings,'data.instagram',$key);?>" class="form-control limitter" placeholder="Instagram" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label">Youtube</label>
    <input type="text" name="data[<?php echo $key?>][youtube]" value="<?php echo get($Settings,'data.youtube',$key);?>" class="form-control limitter" placeholder="Youtube" maxlength="160">
</div>
<div class="alert bg-warning-lt text-12 mt-3 mb-1"><?php echo __('Enter your username in social media accounts');?></div>