<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SitemapMain extends Controller {
    public function process() {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        
        header("Content-Type: application/xml; charset=utf-8");
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        echo '<url>';
        echo '<loc>'.APP.'</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';
        echo '<url>';
        echo '<loc>'.APP.'/cursos</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';

        echo '<url>';
        echo '<loc>'.APP.'/collections</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';

        echo '<url>';
        echo '<loc>'.APP.'/discussions</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';

        echo '<url>';
        echo '<loc>'.APP.'/actors</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';

        echo '<url>';
        echo '<loc>'.APP.'/categories</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';

        echo '<url>';
        echo '<loc>'.APP.'/discovery</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';
        echo '<url>';
        
        echo '<loc>'.APP.'/trends</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '<changefreq>hourly</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';
     
        echo '</urlset>'; 
       

    }

}