<div class="modal-content">
    <div class="modal-body">
        <form method="post">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
            <input type="hidden" name="content_id" value="<?php echo Input::cleaner($_GET['id']);?>">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Report');?></label>
                <?php require PATH . '/config/array.config.php';?>
                <select name="report_id" class="custom-select" required="true">
                    <option value=""><?php echo __('Selecione');?></option>
                    <?php foreach ($Reports as $Value => $Key) { ?>
                    <option value="<?php echo $Value;?>">
                        <?php echo $Key;?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <?php if ($AuthUser['id']) { ?>
            <div class="form-group" style="display:none">
                <label class="custom-label">Email or Username</label>
                <textarea name="user" class="form-control" placeholder="Please insert your username or email." style="height:47.5px;" required="true"><?php echo $AuthUser['username']; ?></textarea>
            </div> 
			<?php } else { ?>
            <div class="form-group">
                <label class="custom-label">Email or Username</label>
                <textarea name="user" class="form-control" placeholder="Please insert your username or email." style="height:47.5px;" required="true"></textarea>
            </div> 
        	<?php } ?>
            <div class="form-group" style="display:none">
                <label class="custom-label">URL</label>
                <textarea name="url" class="form-control" placeholder="Please insert your username or email." style="height:47.5px;" required="true" readonly><?php echo $_SERVER['HTTP_REFERER']; ?></textarea>
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Description');?></label>
                <textarea name="body" class="form-control" placeholder="<?php echo __('Could you please give some detail about the problem ?');?>"></textarea>
            </div>
        	<div style="background-color: #47370b!important;border-radius: 5px;color: #ffc526!important;padding: 20px;margin-bottom: 15px;">
            Se você estiver logado, você pode visualizar o status do conteúdo relatado em seu perfil.
        	</div>
            <button type="submit" class="btn btn-theme btn-block"><?php echo __('Submit');?></button>
        </form>
    </div>
</div>
<script type="text/javascript">
$(".modal form").submit(function() {
    $.ajax({
        url: _URL + '/ajax/report',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(resp) {
            Snackbar.show({ text: resp.text, customClass: 'bg-' + resp.status });
            $('.modal').modal('hide');
        }
    });
    return false;
});
</script>
