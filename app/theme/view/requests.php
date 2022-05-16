<?php 

        $Listings = $this->db->from(null,'
            SELECT 
            requests.id,
            requests.url,
            requests.status,
            requests.title,
            requests.type
            FROM `requests`')
            ->all();


require PATH . '/theme/view/common/header.php';?>
<div class="app-content">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo APP;?>"><?php echo __('Home');?></a></li>
            <li class="breadcrumb-item active"><a href="<?php echo APP.'/requests';?>"><?php echo __('Requests');?></a></li>
        </ol>
    </nav>

<div class="table-responsive">
    <table class="table table-theme table-row v-middle" style="border-collapse: separate!important;border-spacing: 0 8px!important;">
        <thead class="text-muted">
            <tr>
                <th width="80" style="font-size: 12px; font-weight: 500; border: 0; padding: .25rem 2rem;"></th>
                <th style="font-size: 12px; font-weight: 500; border: 0; padding: .25rem 2rem;"><?php echo __('Request');?></th>
                <th style="font-size: 12px; font-weight: 500; border: 0; padding: .25rem 2rem;"><?php echo __('Type');?></th>
                <th class="text-right" style="font-size: 12px; font-weight: 500; border: 0; padding: .25rem 2rem;"></th>
            </tr>
        </thead>
        <tbody style="border-spacing: 0 8px!important;">
            <?php foreach ($Listings as $Listing) { ?>
			<tr style="height:40px;background-color:#101010;">
   				<th width="80" style="border: none;font-weight: 500;color: #969696!important;font-size:14px;padding: 1.1rem 2rem;border-radius:6px 0px 0px 6px;">
      				#<?php echo htmlspecialchars($Listing['id']);?>
   				</th>
   				<th style="border: none;font-weight: 500;color: #969696!important;font-size:14px;padding: 1.1rem 2rem;vertical-align: middle;">
      				<?php echo htmlspecialchars($Listing['title']); ?>
   				</th>
   				<th style="border: none;font-weight: 500;color: #969696!important;font-size:12px;padding: 1.1rem 2rem;vertical-align: middle;">
      				<?php echo htmlspecialchars($Listing['type']); ?>
   				</th>
   				<th style="border: none;float:right;border-radius:0px 6px 6px 0px;padding: 1.1rem;">
      				<?php if ($Listing['status'] == 2) { ?><span style="padding: 5px 10px;border-radius: 3px;font-size: 10px;" class="badge bg-warning-lt ml-2">Request Pending</span><?php } else { ?> <div style="padding: 5px 10px;border-radius: 3px;font-size: 10px;" class="badge bg-primary-lt ml-2">Request Filled</div><?php } ?>
   				</th>
			</tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>
