<?php if(get($Settings,'data.showpages','general') == 0) { ?>
<ul class="nav flex-column nav-filter pl-md-4">
    <li class="nav-item nav-header mt-0 pb-2"><?php echo __('Pages');?></li>
    <?php 
            $Pages = $this->db->from('pages')->where('status',1)->all();
            foreach ($Pages as $Page) { 
            ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo APP.'/page/'.$Page['self'];?>">
            <?php echo $Page['name'];?></a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo APP.'/contact';?>"><?php echo __('Contact');?></a>
    </li>
</ul>
<?php } ?>
