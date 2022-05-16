<?php

        $ReportsListing = $this->db->from(null,'
            SELECT 
            reports.id,
            reports.report_id,
            reports.body,
            reports.user as username,
            reports.created,
            reports.url,
            reports.status,
            posts.title,
            posts.type
            FROM `reports`
            LEFT JOIN posts ON reports.content_id = posts.id AND reports.content_id
            WHERE reports.user = "'.$Listing['username'].'"
            ORDER BY reports.id DESC  
            LIMIT 5')
            ->all();

?>
<style>
@media only screen and (max-width: 763px) {
  .report-title {
    display: none;
  }
}
</style>
<div class="profile-box">
    <div class="profile-heading">
        <?php echo __('Reported Content');?>
    </div>
<table style="border-spacing: 0 8px!important;border-collapse: separate!important;width:100%;">
<tbody>  
  		<tr>
    		<th style="font-size:12px;color:#fff;font-weight: 400;">Número Ticket</th>
    		<th class="report-title" style="font-size:12px;color:#fff;font-weight: 400;">Curso</th>
    		<th style="font-size:12px;color:#fff;font-weight: 400;"></th>
  		</tr>
    <?php foreach ($ReportsListing as $Report) { ?>
  		<tr id="click-<?php echo $Report['id']; ?>" style="background-color:#101010;height:60px;line-height:60px;border-radius:5px;">
    		<th style="padding-left:35px;border: none; border-radius: 5px 0px 0px 5px;font-weight: 400;"><?php echo $Report['id']; ?></th>
    		<th class="report-title" style="border: none;font-weight: 400;"><?php echo $Report['title']; ?></th>
    		<th style="border: none;border-radius: 0px 5px 5px 0px;font-weight: 400;">
            	<a href="<?php echo $Report['url'];?>" target="_blank">
                 	<i style="font-size:20px;float:right;padding-right:35px;margin-top:6px;" class="fas fa-eye"></i>
                </a>
             	<?php if ($Report['status'] == 1) { echo '<span class="badge bg-warning-lt ml-2" style="color: #ffffff !important; background-color: #0a7201 !important; float:right;padding:8px;margin-right:25px;margin-top:3px;">Resolvido</span>'; } else { echo '<span class="badge bg-warning-lt ml-2" style="float:right;padding:8px;margin-right:25px;margin-top:3px; background-color: #b50000 !important; color: #ffffff !important; ">Aguardando Solução</span>'; }?>
        	</th>
  		</tr>
    <?php } ?>
</tbody>
</table>
</div>
