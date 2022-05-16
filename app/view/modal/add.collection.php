<div class="modal-content bg-body">
    <div class="modal-body p-5">
        <div class="form-group">
            <label class="custom-label"><?php echo __('Movie or TV Series Name');?></label>
            <select name="name" class="form-control selectize-collection" data-placeholder="<?php echo __('Movie or TV Series Name');?>" data-ajax="posts">
            </select>
        </div>
    </div>
</div>
<script type="text/javascript">
(function($) {
    "use strict";
    $('.selectize-collection').selectize({
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: [],
        maxItems: 1,
        render: {
            option: function(item, escape) {
                return '<div class="d-flex align-items-center px-3 py-1">' +
                    '<div class="media media-cover-temp w-sm-thumb lazy" data-src="' + escape(item.image) + '"></div>' +
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
                url: URL + '/admin/ajax/' + this.settings.dataAjax + '?q=' + encodeURIComponent(query),
                type: 'GET',
                dataType: 'json',
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data.slice(0, 10));
                }
            });
        },
        create: false,
        onChange: function(value) {
            $.ajax({
                url: URL + '/admin/ajax/post?id=' + value,
                type: 'GET',
                dataType: 'json',
                success: function(resp) {
                    var id = $(".collection-accordion").children().length;
                    var movieDetail = [{
                        id: id,
                        name: resp.data[0].name,
                        type: resp.data[0].type,
                        type_name: resp.data[0].type_name,
                        content_id: resp.data[0].content_id,
                        image: resp.data[0].image
                    }]; 
                    $('#card-collection').tmpl(movieDetail).appendTo('.collection-accordion');
                    $('.modal').modal('hide');
                    Snackbar.show({ text: resp.text, customClass: 'bg-' + resp.status });
                    $('.lazy').lazy();
                }
            });
        }
    });
    $('.selectize-input').find('input').focus();
})(jQuery);
</script>