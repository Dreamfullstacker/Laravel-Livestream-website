<div class="modal-content bg-body">
    <div class="modal-body p-5">
        <div class="form-group">
            <label class="custom-label">
                <?php echo __('Actor');?></label>
            <select name="actor" class="form-control selectize-actor" data-placeholder="<?php echo __('Actor');?>" data-ajax="actors">
            </select>
        </div>
    </div>
</div>
<script type="text/javascript">
(function($) {
    "use strict";
    $('.selectize-actor').selectize({
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: [],
        maxItems: 1,
        render: {
            option: function(item, escape) {
                return '<div class="d-flex align-items-center px-3 py-1">' +
                    '<div class="media media-actor w-sm-thumb lazy" data-src="' + escape(item.image) + '"></div>' +
                    '<div class="ml-3">' +
                    (item.name ? '<div class="name">' + escape(item.name) + '</div>' : '') +
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
                url: URL + '/admin/ajax/actorget?id=' + value,
                type: 'GET',
                dataType: 'json',
                success: function(resp) {
                    var id = $(".actors-accordion").children().length;
                    var actorDetail = [{
                        id: id,
                        name: resp.data[0].name,
                        actor_id: resp.data[0].id,
                        image: resp.data[0].image,
                        api_id: resp.data[0].api_id,
                        imdb_id: resp.data[0].imdb_id
                    }];
                    $('#card-actor').tmpl(actorDetail).appendTo('.actors-accordion');
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