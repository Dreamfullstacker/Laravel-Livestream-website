<?php require PATH . '/view/common/header.php';?>
<form method="post" autocomplete="off" enctype="multipart/form-data" class="form-content">
    <div class="d-md-flex">
        <div class="flex-fill">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token; ?>">
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Name');?></label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="<?php echo __('Name');?>" value="<?php echo $Listing['name'];?>" required="true">
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Username');?></label>
                <input type="text" name="username" class="form-control" placeholder="<?php echo __('Username');?>" value="<?php echo $Listing['username'];?>" required="true">
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Email');?></label>
                <input type="email" name="email" class="form-control" placeholder="<?php echo __('Email');?>" value="<?php echo $Listing['email'];?>" required="true">
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Password');?></label>
                <input type="password" name="password" class="form-control" placeholder="<?php echo __('Password');?>" value="">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="custom-label">
                            <?php echo __('Gender');?></label>
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
                        <label class="custom-label">
                            <?php echo __('Location');?></label>
                        <input type="text" name="data[location]" class="form-control" placeholder="<?php echo __('Location');?>" value="<?php echo $Data['location'];?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('About');?></label>
                <textarea name="data[about]" class="form-control" placeholder="<?php echo __('About');?>"><?php echo $Data['about'];?></textarea>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Facebook</label>
                        <input type="text" name="data[social][facebook]" class="form-control" placeholder="Facebook" value="<?php echo $Data['social']['facebook'];?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Twitter</label>
                        <input type="text" name="data[social][twitter]" class="form-control" placeholder="Twitter" value="<?php echo $Data['social']['twitter'];?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Instagram</label>
                        <input type="text" name="data[social][instagram]" class="form-control" placeholder="Instagram" value="<?php echo $Data['social']['instagram'];?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="custom-label">Youtube</label>
                        <input type="text" name="data[social][youtube]" class="form-control" placeholder="Instagram" value="<?php echo $Data['social']['youtube'];?>">
                    </div>
                </div>
            </div>
            <div class="alert bg-warning-lt text-12 mt-3 mb-1">
                <?php echo __('Enter your username in social media accounts');?>
            </div>
            <script type="text/javascript">
            $(document).ready(function() {
                $('.datepicker-form').datepicker();
            });
            </script>
        </div>
        <div class="app-aside-right">
            <div class="form-group">
                <div class="media-select media" style="background-image: url(<?php if($Listing['avatar']) echo UPLOAD.'/user/'.$Listing['avatar']?>);">
                    <div class="media-btn" id="input-cover">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                        </svg>
                    </div>
                    <div class="media-remove" data-id="<?php echo $Listing['id'];?>">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="image" class="media-input d-none" id="file-input-cover" data-preview="media-select">
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Type');?></label>
                <select name="account_type" class="custom-select" required="true">
                    <option value="">
                        <?php echo __('Type');?>
                    </option>
                    <option value="admin" <?php if($Listing['account_type']=='admin' ) echo 'selected=""' ;?>>
                        <?php echo __('Admin');?>
                    </option>
                    <option value="supporter" <?php if($Listing['account_type']=='supporter' ) echo 'selected=""' ;?>>
                        <?php echo __('Supporter');?>
                    </option>
                    <option value="user" <?php if($Listing['account_type']=='user' ) echo 'selected=""' ;?>>
                        <?php echo __('User');?>
                    </option>
                </select>
            </div>
            <div class="form-group">
                <div class="switch-container">
                    <label class="switch"><input name="banned" type="checkbox" value="1" <?php if($Listing['banned']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                        <?php echo __('Banned');?></label>
                </div>
                <div class="switch-container">
                    <label class="switch"><input name="chatboxban" type="checkbox" value="1" <?php if($Listing['chatboxban']=='1' ) echo 'checked="true"' ;?>><span class="switch-button"></span>
                        <?php echo __('Banned from Chatbox');?></label>
                </div>
            	<br><br>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Reason for chatbox ban');?>:</label>
                <textarea name="data[chatboxbanreason]" class="form-control" placeholder="<?php echo __('Reason for chatbox ban');?>"><?php echo $Data['chatboxbanreason'];?></textarea>
            </div>
            </div>
            <button type="submit" class="btn btn-theme btn-lg btn-block">
                <?php echo __('Save Changes');?></button>
        </div>
    </div>
</form> 
<?php require PATH . '/view/common/footer.php';?>
