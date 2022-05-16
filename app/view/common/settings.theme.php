<div class="form-group">
    <label class="custom-label"><?php echo __('General Color');?></label>
    <input type="text" name="data[<?php echo $key;?>][general]" class="form-control colorpicker" data-control="hue" value="<?php echo get($Settings, 'data.general', $key );?>">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Button Colors');?></label>
    <input type="text" name="data[<?php echo $key;?>][button]" class="form-control colorpicker" data-control="hue" value="<?php echo get($Settings, 'data.button', $key );?>">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Dashboard Colors');?></label>
    <input type="text" name="data[<?php echo $key;?>][dashboard]" class="form-control colorpicker" data-control="hue" value="<?php echo get($Settings,'data.dashboard', $key );?>">
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Theme');?> <?php echo __('Color');?></label>
    <div class="switch-container">
        <label class="switch"><input class="check" name="data[<?php echo $key?>][darktheme]" type="checkbox" value="1" <?php if(get($Settings,'data.darktheme',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Dark');?> <?php echo __('Theme');?></label><span style="margin-right:10%;"></span>
        <label class="switch"><input class="check" name="data[<?php echo $key?>][lighttheme]" type="checkbox" value="1" <?php if(get($Settings,'data.lighttheme',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Light');?> <?php echo __('Theme');?></label><span style="margin-right:10%;"></span>
        <label class="switch"><input class="check" name="data[<?php echo $key?>][purpletheme]" type="checkbox" value="1" <?php if(get($Settings,'data.purpletheme',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Purple');?> <?php echo __('Theme');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Scrollable Home Page');?></label>
		<br>
	<label class="custom-label">This makes movies and tv shows on the home page scroll as opposed to appear in a block.</label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][scrollablehome]" type="checkbox" value="1" <?php if(get($Settings,'data.scrollablehome',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Scrollable Home Page');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Sliding Menu');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][slidingmenu]" type="checkbox" value="1" <?php if(get($Settings,'data.slidingmenu',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Sliding Menu');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Show Menu Icon');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][menuicon]" type="checkbox" value="1" <?php if(get($Settings,'data.menuicon',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Menu Icon');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Show Pages in Sidebar');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][showpages]" type="checkbox" value="1" <?php if(get($Settings,'data.showpages',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Pages in Sidebar');?></label>
    </div>
</div>
<div class="form-group">
    <label class="custom-label"><?php echo __('Show RSS Feeds');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][rssfeed]" type="checkbox" value="1" <?php if(get($Settings,'data.rssfeed',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show RSS Feeds');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Show Movie Feed');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][moviefeed]" type="checkbox" value="1" <?php if(get($Settings,'data.moviefeed',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Moive Feed');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Show TV Show Feed');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][showfeed]" type="checkbox" value="1" <?php if(get($Settings,'data.showfeed',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Show Feed');?></label>
    </div>
</div> 
<div class="form-group">
    <label class="custom-label"><?php echo __('Show Episode Feed');?></label>
    <div class="switch-container">
        <label class="switch"><input name="data[<?php echo $key?>][episodefeed]" type="checkbox" value="1" <?php if(get($Settings,'data.episodefeed',$key)=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span><?php echo __('Show Episode Feed');?></label>
    </div>
</div> 
