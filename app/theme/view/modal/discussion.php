<div class="modal-content">
    <div class="modal-body">
        <form method="post" action="<?php echo APP.'/discussions';?>">
            <input type="hidden" name="_ACTION" value="save">
            <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
            <div class="form-group">
                <label class="custom-label"><?php echo __('Title');?></label>
                <input type="text" name="title" class="form-control form-control-lg" placeholder="<?php echo __('Title');?>" required="true">
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Description');?></label>
                <textarea name="body" class="form-control" placeholder="<?php echo __('Description');?>" required="true"></textarea>
            </div>
            <div class="form-group">
                <label class="custom-label"><?php echo __('Related Content');?></label>
                <select name="content_id" class="form-control selectize-ajax" data-placeholder="<?php echo __('Related Content');?>" data-ajax="posts">
                    <option value=""><?php echo __('Related Content');?></option>
                </select>
            </div>
            <button type="submit" class="btn btn-theme btn-lg btn-block"><?php echo __('Create');?></button>
        </form>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('.selectize-ajax').selectize({
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: [],
        maxItems: 1,
        render: {
            option: function(item, escape) {
                return '<div class="d-flex align-items-center px-3 py-1">' +
                    '<div class="media media-cover w-sm-thumb" data-src="' + escape(item.image) + '"></div>' +
                    '<div class="ml-3">' +
                    (item.name ? '<div class="name">' + escape(item.name) + '</div>' : '') +
                    (item.type ? '<div class="text-muted text-12">' + escape(item.type) + '</div>' : '') +
                    '</div>' +
                    '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: _URL + '/admin/ajax/' + this.settings.dataAjax + '?q=' + encodeURIComponent(query),
                type: 'GET',
                dataType: 'json',
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data.slice(0, 10));
                    $('.media').lazy();
                }
            });
        },
        create: false,
    });
});
</script>