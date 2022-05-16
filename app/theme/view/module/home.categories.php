<div class="app-section">
   <div class="app-heading">
        <div class="text">
            <?php echo $HomeModule['name'];?>
        </div>
        <a href="<?php echo APP.'/categories';?>" class="all"><?php echo __('All');?></a>
    </div>
    <div class="row row-cols-5 list-scrollable">
        <?php   
        $Categories         = $this->db->from("categories")->where('featured','1')->where('status',1)->limit(0,$HomeModule['data_limit'])->all();
        foreach ($Categories as $Category) {
        ?>
        <div class="col">
            <a href="<?php echo APP.'/category/'.$Category['self'];?>" class="list-category-box" style="background-color: <?php echo $Category['color'];?>" title="<?php echo $Category['name'];?>">
                <?php echo $Category['name'];?>   
            </a>
        </div>
        <?php } ?>
    </div>
</div>
