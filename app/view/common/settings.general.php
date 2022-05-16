<div class="form-group">
    <label class="custom-label"><?php echo __('Maintainence Mode');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][maintainence]" type="checkbox" value="1" <?php if(get($Settings,'data.maintainence',$key)=='1' ) echo 'checked="false"' ;?>><span class="switch-button"></span><?php echo __('Maintainence Mode');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Google Adsense Mode');?>:</label>
		<br>
    <label class="custom-label">Google Adsense mode disables all copyrighted material for all users so your website looks more like a IMDb or TMDb alternative as oppose to a streaming site, this *should* get your website approved for Ad Sense.</label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][googleadsense]" type="checkbox" value="1" <?php if(get($Settings,'data.googleadsense',$key)=='1' ) echo 'checked="false"' ;?>><span class="switch-button"></span><?php echo __('Google Adsense Mode');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Site Name');?></label>
    <input type="text" name="data[<?php echo $key?>][company]" value="<?php echo get($Settings,'data.company', $key);?>" class="form-control" placeholder="<?php echo __('Site Name');?>" maxlength="255">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Site Title');?></label>
    <input type="text" name="data[<?php echo $key?>][title]" value="<?php echo get($Settings,'data.title', $key);?>" class="form-control form-control-lg" placeholder="<?php echo __('Site Title');?>" maxlength="160">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Site Description');?></label>
    <input type="text" name="data[<?php echo $key?>][description]" value="<?php echo get($Settings, 'data.description', $key);?>" class="form-control form-conxtrol-theme" placeholder="<?php echo __('Site Description');?>" maxlength="255">
</div>
<div class="form-group">
    <label class="custom-label">Logo</label>
    <div class="custom-file">
        <input name="logo" type="file" class="custom-file-input" id="customFileLang">
        <label class="custom-file-label" for="customFileLang" data-browse="<?php echo __('Select Image');?>"><img src="<?php echo LOCAL.'/'.get($Settings,'data.logo',$key);?>" height="15px;" /></label>
    </div> 
</div>
<div class="form-group">
    <label class="custom-label">Favicon</label>
    <div class="custom-file">
        <input name="favicon" type="file" class="custom-file-input" id="customFileLang">
        <label class="custom-file-label" for="customFileLang" data-browse="<?php echo __('Select Image');?>"><img src="<?php echo LOCAL.'/'.get($Settings,'data.favicon','general');?>" height="15px;" /></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Language');?></label>
    <select name="data[<?php echo $key?>][language]" class="custom-select">
        <?php foreach ($Languages as $Language) { ?>
        <option value="<?php echo $Language['short_name'];?>" <?php if(get($Settings,'data.language',$key) == $Language['short_name']) echo 'selected';?>><?php echo $Language['name'];?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Dashboard Language');?></label>
    <select name="data[<?php echo $key?>][dashboard_language]" class="custom-select">
        <?php foreach ($Languages as $Language) { ?>
        <option value="<?php echo $Language['short_name'];?>" <?php if(get($Settings,'data.dashboard_language',$key) == $Language['short_name']) echo 'selected';?>><?php echo $Language['name'];?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Members Only');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][members]" type="checkbox" value="1" <?php if(get($Settings,'data.members',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Members Only');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Comments');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][comment]" type="checkbox" value="1" <?php if(get($Settings,'data.comment',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Confirm comments add');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Discussions');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][discussion]" type="checkbox" value="1" <?php if(get($Settings,'data.discussion',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Confirm discussions add');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Get Subtitles');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][getsubtitles]" type="checkbox" value="1" <?php if(get($Settings,'data.getsubtitles',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Enable Get Subtitles Button');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Get Downloads');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][getdownloads]" type="checkbox" value="1" <?php if(get($Settings,'data.getdownloads',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Enable Get Downloads Button');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Custom Code');?></label>
    <textarea name="data[<?php echo $key?>][headcode]" class="form-control"><?php echo get($Settings,'data.headcode',$key);?></textarea>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Footer Description');?></label>
    <textarea name="data[<?php echo $key?>][footer_text]" class="form-control summernote"><?php echo htmlspecialchars_decode(get($Settings,'data.footer_text',$key));?></textarea>
</div>
