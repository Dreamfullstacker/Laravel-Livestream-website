</div>
</div>
<div class="float-right"><?php echo __('Version');?> 3.3.3</div>
<!-- .modal -->
<div id="m" class="modal" data-backdrop="static">
    <button class="modal-close" data-dismiss="modal">
        <svg class="icon">
            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
        </svg>
    </button>
    <div class="modal-dialog modal-lg modal-dialog-centered">
    </div>
</div>
<div class="loader">
    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
        <circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
    </svg>
</div>
<script src="<?php echo ASSETS.'/js/jquery.min.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.ui.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/bootstrap.bundle.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.lazy.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.snackbar.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.tmpl.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.datepicker.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.colorpicker.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/jquery.summernote.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/selectize.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/app.js?v='.VERSION;?>"></script>
<script src="<?php echo ASSETS.'/js/post.js?v='.VERSION;?>"></script>
<?php if ($_SESSION['notify']['display'] == 'hidden') {?>
<script type="text/javascript">
(function ($) {
    'use strict';
    Snackbar.show({ text: '<?php echo $_SESSION["notify"]["text"] ?>', customClass: 'bg-<?php echo $_SESSION["notify"]["type"] ?>' });
})(jQuery);
</script>
<?php } ?>
<script>
$(document).ready(function(){
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});
</script>
</body>

</html>
