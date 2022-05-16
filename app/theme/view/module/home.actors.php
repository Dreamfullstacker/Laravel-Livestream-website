<div class="app-section">
<div class="app-heading">
<div class="text"><?php echo $HomeModule['name'];?></div>
<a href="<?php echo APP.'/actors';?>" class="all"><?php echo __('All');?></a>
</div>
<div class="row row-cols-6 list-scrollable">
<?php
$Actors = $this->db->from("actors")->where('featured','1')->limit(0,$HomeModule['data_limit'])->all();
foreach ($Actors as $Actor) {
?>
<div class="col">
<div class="list-actor">
<a href="<?php echo actor($Actor['id'],$Actor['name']);?>" class="list-media" title="<?php echo $Actor['name'];?>">
<div class="media" data-src="<?php echo UPLOAD.'/actor/'.$Actor['image'];?>"></div>
</a>
<div class="list-caption">
<a href="<?php echo actor($Actor['id'],$Actor['name']);?>" class="list-title" title="<?php echo $Actor['name'];?>">
<?php echo $Actor['name'];?></a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
