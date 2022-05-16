<?php require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active"><a href="<?php echo APP.'/request';?>"><?php echo __('pppppp');?></a></li>
        </ol>
    </nav>
	<div class="text-24 text-white font-weight-bold">Make a Request</div>
	<div class="text-12 text-white">Make a request by filling out the form below.</div>
		<br>
	<form method="post" action="/request?status=success" autocomplete="off"> 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="custom-label"><?php echo __('Movie or Series Title');?></label>
                    <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Movie or Series Title');?>" required>
                </div>
                <div class="form-group">
                	<label class="custom-label"><?php echo __('Movie or Series');?></label>
                	<select name="type" class="custom-select" required>
                  		<option hidden>
                      		<?php echo __('Select One');?>
                    	</option>
                  		<option value="movie">
                      		<?php echo __('Movie');?>
                    	</option>
                    	<option value="series">
                        	<?php echo __('Series');?>
                    	</option>
               		</select>
                </div>
                <div class="form-group">
                    <label class="custom-label"><?php echo __('IMDb URL');?></label>
                    <input type="url" name="url" class="form-control form-control-lg" placeholder="<?php echo __('Insert IMDb URL');?>" required>
                </div>
					<br>
                <button type="submit" name="save" class="btn btn-theme btn-lg d-block d-md-inline-block mb-4 px-5" style="width:200px;"><?php echo __('Save Changes');?></button>
        	</div>
		</div>
	</form>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
