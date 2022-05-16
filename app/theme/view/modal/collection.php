<div class="modal-content">
    <div class="modal-body">
        <div class="mb-4">
            <div class="text-12 mb-2 text-muted"><?php echo __('Collections');?></div>
            <div class="collections"></div>
        </div>
        <input type="hidden" name="post_id" value="<?php echo Input::cleaner($_GET['id']);?>">
        <div class="text-12 mb-2 text-muted"><?php echo __('Create New Collection');?></div>
        <form method="post" class="collection-form">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
            <div class="form-row">
                <div class="col-md-8">
                    <input type="text" name="name" class="form-control" placeholder="<?php echo __('Name');?>" autofocus="true">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-theme btn-block"><?php echo __('Create');?></button>
                </div>
            </div>
            <div class="switch-container mt-2">
                <label class="switch"><input name="privacy" type="checkbox" value="2">
                    <span class="switch-button"></span>
                    <span class="switch-label"><?php echo __('Only me');?></span>
                </label>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(function() {

    var content_id = $('[name="post_id"]').val();
    $.ajax({
        url: _URL + '/ajax/collections',
        type: 'POST',
        data: 'content_id=' + content_id,
        dataType: 'json',
        success: function(resp) {
            $('#card-collection').tmpl(resp.data).appendTo('.collections');
        }
    });

    $(".collection-form").submit(function() {
        $.ajax({
            url: _URL + '/ajax/collection',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(resp) {
                Snackbar.show({ text: resp.text, customClass: 'bg-' + resp.status });
                $('#card-collection').tmpl(resp.data).appendTo('.collections');
            }
        });
        return false;
    }); 
});
</script>
<script id="card-collection" type="text/x-jquery-tmpl">
    <div class="switch-container">
    <label class="switch">
        <input name="collection" type="radio" value="${id}" {{if selected===true}}checked="true"{{/if}}>
        <span class="switch-button"></span>
        <span class="switch-label">${name}</span>
    </label>
</div>
</script>