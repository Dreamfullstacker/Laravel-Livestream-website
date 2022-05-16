<form method="post" id="controls" class="step">
<input type="hidden" name="_ACTION" value="install">
<div class="subsection">
<?php if($Notify) { ?><div class="bg-warning-lt alert"><?php echo $Notify;?></div><?php } ?>
<p>Please download the following SQL file and execute it on your existing database, please back up existing databases in case of errors. If you misses an upgrade cycle then please apply the SQL patches one at a time in release order to prevent any missing tables.</p>
<br />
Version 2.X.X > Version 3.0.0 <a style="float:right;color:#3dd598" href="db/3.0.0.sql">Download</a>
<br /><br>
Version 3.0.0 > Version 3.0.1 <a style="float:right;color:#3dd598" href="db/3.0.1.sql">Download</a>
<br /><br>
Version 3.0.1 > Version 3.0.2 <a style="float:right;color:#3dd598" href="db/3.0.2.sql">Download</a>
<br /><br>
Version 3.0.2 > Version 3.1.0 <a style="float:right;color:#3dd598" href="db/3.1.0.sql">Download</a>
<br /><br>
Version 3.1.0 > Version 3.1.1 <a style="float:right;color:#3dd598" href="db/3.1.0.sql">No SQL Changes</a>
<br /><br>
Version 3.1.1 > Version 3.1.2 <a style="float:right;color:#3dd598" href="db/3.1.0.sql">No SQL Changes</a>
<br /><br>
Version 3.1.2 > Version 3.1.3 <a style="float:right;color:#3dd598" href="db/3.1.3.sql">Download</a>
<br /><br>
Version 3.1.3 > Version 3.2.0 <a style="float:right;color:#3dd598" href="db/3.2.0.sql">Download</a>
<br /><br>
Version 3.2.0 > Version 3.3.0 <a style="float:right;color:#3dd598" href="db/3.3.0.sql">Download</a>
<br /><br><br /><br>
<p>Remember to delete Install and Upgrade folders</p>
<center> <a href="../" class="btn btn-primary next-btn btn-lg px-5 mx-auto">Finish Installation</a></center>
</div>
</form>
