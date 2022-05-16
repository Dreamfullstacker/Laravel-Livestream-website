<br>
<label class="custom-label" style="color:#fff">To make your site PWA compliant please insert the code below into manifest.json on your install base directory. If you ever change your site settings such as name, url or colors you'll need to update this file.</label>
<br>
<pre style="color:#fff">manifest.json:</pre>
<pre style="color:#fff">
{
  "name": "<?php echo get($Settings,'data.company', 'general');?>",
  "short_name": "<?php echo get($Settings,'data.company', 'general');?>",
  "start_url": "<?php echo APP;?>",
  "display": "standalone",
  "background_color": "#000",
  "theme_color": "#000",
  "description": "<?php echo get($Settings,'data.description', 'general');?>",
  "orientation": "all",
  "icons": [
    {
      "src": "<?php echo APP;?>/public/static/<?php echo get($Settings,'data.logo', 'general');?>",
      "type": "image/png", "sizes": "512x512"
    }
  ]
}
</pre>
