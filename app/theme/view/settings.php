<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active"><a href="<?php echo APP.'/settings';?>"><?php echo __('Settings');?></a></li>
        </ol>
    </nav>
    <form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
        <input type="hidden" name="_ACTION" value="save">
        <input type="hidden" name="_TOKEN" value="<?php echo $Token; ?>">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
            	<label class="custom-label"><?php echo __('Profile Picture');?></label>
                    <div class="media-select media" style="background-image: url(<?php if($AuthUser['avatar']) echo UPLOAD.'/user/'.$AuthUser['avatar']?>);">
                        <div class="media-btn" id="input-cover">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                            </svg>
                        </div>
                        <div class="media-remove" data-id="<?php echo $AuthUser['id'];?>">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
                            </svg>
                        </div>
                    </div>
                    <input type="file" name="image" class="media-input d-none" id="file-input-cover" data-preview="media-select">
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <label class="custom-label"><?php echo __('Name');?></label>
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $AuthUser['name'];?>">
                </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Email');?></label>
                <input type="email" name="email" class="form-control" placeholder="<?php echo __('Email');?>" value="<?php echo $AuthUser['email'];?>" required="true">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Password');?></label>
                <input type="password" name="password" class="form-control" placeholder="<?php echo __('Password');?>" value="">
            </div>
            <div class="form-group">
            	<label class="custom-label"><?php echo __('Language');?></label>
            	<select name="language" class="custom-select">
            		<?php $Languages      = $this->db->from('languages')->orderby('name','ASC')->all(); ?>
        			<?php foreach ($Languages as $Language) { ?>
        				<option value="<?php echo $Language['short_name'];?>" <?php if($AuthUser['language']== $Language['short_name'] ) echo 'selected=""' ;?>><?php echo $Language['name'];?></option>
        			<?php } ?>
            	</select>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="custom-label"><?php echo __('Gender');?></label>
                            <select name="data[gender]" class="custom-select">
                            <option value="">
                                <?php echo __('Gender');?>
                            </option>
                            <option value="2" <?php if($Listing['gender']=='2' ) echo 'selected=""' ;?>>
                                <?php echo __('Male');?>
                            </option>
                            <option value="1" <?php if($Listing['gender']=='1' ) echo 'selected=""' ;?>>
                                <?php echo __('Female');?>
                            </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="custom-label"><?php echo __('Location');?></label>
                            <input type="text" name="data[location]" class="form-control" placeholder="<?php echo __('Location');?>" value="<?php echo $AuthSettings['location'];?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="custom-label"><?php echo __('About');?></label>
                    <textarea name="data[about]" class="form-control" placeholder="<?php echo __('About');?>"><?php echo $AuthSettings['about'];?></textarea>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="custom-label">Facebook</label>
                            <input type="text" name="data[social][facebook]" class="form-control" placeholder="Facebook" value="<?php echo $AuthSettings['social']['facebook'];?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="custom-label">Twitter</label>
                            <input type="text" name="data[social][twitter]" class="form-control" placeholder="Twitter" value="<?php echo $AuthSettings['social']['twitter'];?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="custom-label">Instagram</label>
                            <input type="text" name="data[social][instagram]" class="form-control" placeholder="Instagram" value="<?php echo $AuthSettings['social']['instagram'];?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="custom-label">Youtube</label>
                            <input type="text" name="data[social][youtube]" class="form-control" placeholder="Youtube" value="<?php echo $AuthSettings['social']['youtube'];?>">
                        </div>
                    </div>
                </div>
            <div class="alert bg-warning-lt text-12 mb-3">
                <?php echo __('Enter your username in social media accounts');?>
            </div>
                <button type="submit" class="btn btn-theme btn-lg d-block d-md-inline-block mb-4 px-5"><?php echo __('Save Changes');?></button>
            </div>
        </div>
    </form>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
