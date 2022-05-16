<?php $installable = true; ?>
<div id="requirements" class="step">
<div class="subsection">
<div class="subsection-title">1. Please configure PHP to match following requirements / settings:</div>
<table>
<thead>
<tr>
<th width="30%">PHP Settings</th>
<th width="30%">Required</th>
<th width="30%">Current</th>
<th width="10%" class="status">&nbsp;</th>
</tr>
</thead>
<tbody>
<tr>
<td><span class="font-weight-bold">PHP Version</span></td>
<td>5.6.0+</td>
<td><?= PHP_VERSION ?></td>
<td class="status">
<?php if (version_compare(PHP_VERSION, '5.6.0') >= 0): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<td><span class="font-weight-bold">allow_url_fopen</span></td>
<td>On</td>
<td><?= ini_get("allow_url_fopen") ? "On" : "Off" ?></td>
<td class="status">
<?php if (ini_get("allow_url_fopen")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
</tbody>
</table>
</div>
<div class="subsection">
<div class="subsection-title">2. Please make sure following extensions are installed and enabled:</div>
<table>
<thead>
<tr>
<th width="30%">Name</th>
<th width="30%">Required</th>
<th width="30%">Current</th>
<th width="10%" class="status">&nbsp;</th>
</tr>
</thead>
<tbody>
<tr>
<?php $curl = function_exists("curl_version") ? curl_version() : false; ?>
<td><span class="font-weight-bold">cURL</span></td>
<td>7.19.4+</td>
<td><?= !empty($curl["version"]) ? $curl["version"] : "Not installed"; ?></td>
<td class="status">
<?php if (!empty($curl["version"]) && version_compare($curl["version"], '7.19.4') >= 0): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<?php $pdo = defined('PDO::ATTR_DRIVER_NAME'); ?>
<td><span class="font-weight-bold">PDO</span></td>
<td>On</td>
<td><?= $pdo ? "On" : "Off"; ?></td>
<td class="status">
<?php if ($pdo): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<?php $gd = extension_loaded('gd') && function_exists('gd_info') ?>
<td><span class="font-weight-bold">GD</span></td>
<td>On</td>
<td><?= $gd ? "On" : "Off"; ?></td>
<td class="status">
<?php if ($gd): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<?php $mbstring = extension_loaded('mbstring') && function_exists('mb_get_info') ?>
<td><span class="font-weight-bold">mbstring</span></td>
<td>On</td>
<td><?= $mbstring ? "On" : "Off"; ?></td>
<td class="status">
<?php if ($mbstring): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<?php $exif = function_exists('exif_read_data') ?>
<td><span class="font-weight-bold">EXIF</span></td>
<td>On</td>
<td><?= $exif ? "On" : "Off"; ?></td>
<td class="status">
<?php if ($exif): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
</tbody>
</table>
</div>
<div class="subsection">
<div class="subsection-title">3. Please make sure following files and directories are writable:</div>
<table>
<thead>
<tr>
<th>File</th>
<th class="status">&nbsp;</th>
</tr>
</thead>
<tbody>
<tr>
<td><span class="font-weight-bold">/index.php</span></td>
<td class="status">
<?php if (is_writeable(ROOTPATH."/index.php")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<td><span class="font-weight-bold">/app/config/db.config.php</span></td>
<td class="status">
<?php if (is_writeable(ROOTPATH."/app/config/db.config.php")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<td><span class="font-weight-bold">/app/config/config.php</span></td>
<td class="status">
<?php if (is_writeable(ROOTPATH."/app/config/config.php")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<td><span class="font-weight-bold">/app/chatlogs/</span></td>
<td class="status">
<?php if (is_writeable(ROOTPATH."/app/chatlogs/")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<td><span class="font-weight-bold">/install/</span></td>
<td class="status">
<?php if (is_writeable(ROOTPATH."/install/")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
<tr>
<?php if (!file_exists(ROOTPATH."/public/upload/")) {@mkdir(ROOTPATH."/public/upload/", "0777", true);} ?>
<td><span class="font-weight-bold">/public/upload/</span></td>
<td class="status">
<?php if (is_writeable(ROOTPATH."/public/upload/")): ?>
<span class="active"><svg><use xlink:href="../public/assets/img/sprite.svg#check" /></svg></span>
<?php else: ?>
<span class="disabled"><svg><use xlink:href="../public/assets/img/sprite.svg#close" /></svg></span>
<?php $installable = false; ?>
<?php endif ?>
</td>
</tr>
</tbody>
</table>
</div>
<div class="subsection">
<div class="subsection-title">4. The following Cron Jobs need to be added for the script to function properly:</div>
<table><thead><tr><th>Sitemap Cron</th><th class="status">&nbsp;</th></tr></thead></table>
0 * * * * /usr/bin/php -f <?php $_SERVER['DOCUMENT_ROOT'] ?>/app/controller/tasks/sitemap.php &> /dev/null
<table>
<thead>
<tr>
<th>
OR it can be run from <a href="https://easycron.com?ref=199435" target="_blank" style="color:#fff;text-decoration:underline;">Easy Cron</a> with the following URL</th>
<th class="status">&nbsp;</th>
</tr>
</thead>
</table>
https://<?php echo $_SERVER['SERVER_NAME'] ?>/app/controller/tasks/sitemap.php
</div>
<div class="gotonext">
<?php if ($installable): ?>
<a href="?step=3" class="btn btn-primary next-btn btn-lg px-5">Next</a>
<?php else: ?>
<div class="bg-warning-lt alert">We are sorry! Your server configuration didn't match the application requirements!</div>
<?php endif; ?>
</div>
</div>
