<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends Controller {
    public function process() {
        $AuthUser   = $this->getVariable("AuthUser");
        $Route      = $this->getVariable("Route");
        
        $Posts          = $this->db->from(null,'SELECT count(posts.id) as total FROM `posts`')->total(); 
        $Episodes       = $this->db->from(null,'SELECT count(posts_episode.id) as total FROM `posts_episode`')->total(); 
        $Actors         = $this->db->from(null,'SELECT count(actors.id) as total FROM `actors`')->total(); 
        $Discussions    = $this->db->from(null,'SELECT count(discussions.id) as total FROM `discussions`')->total(); 
        $Collections    = $this->db->from(null,'SELECT count(collections.id) as total FROM `collections`')->total(); 
        $Categories     = $this->db->from(null,'SELECT count(categories.id) as total FROM `categories`')->total(); 
        $Users          = $this->db->from(null,'SELECT count(users.id) as total FROM `users`')->total();
       
        header("Content-Type: application/xml; charset=utf-8");
        echo '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">';

        echo '<sitemap>';
        echo '<loc>'.APP.'/sitemap.main.xml</loc>';
        echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
        echo '</sitemap>';

        // posts
        for ($ipost=1; $ipost <=ceil($Posts/SITEMAP_PAGE); $ipost++) { 
            echo '<sitemap>';
                echo '<loc>'.APP.'/sitemap.cursos_'.$ipost.'.xml</loc>';
                echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
            echo '</sitemap>';
        }
        // episodes
        // for ($iepisode=1; $iepisode <=ceil($Episodes/SITEMAP_PAGE); $iepisode++) { 
          //  echo '<sitemap>';
          //      echo '<loc>'.APP.'/sitemap.aulas_'.$iepisode.'.xml</loc>';
           //     echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
          //  echo '</sitemap>';
       // }

        // actors
        for ($iactor=1; $iactor <=ceil($Actors/SITEMAP_PAGE); $iactor++) { 
            echo '<sitemap>';
                echo '<loc>'.APP.'/sitemap.professores_'.$iactor.'.xml</loc>';
                echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
            echo '</sitemap>';
        }
        // discussions
        for ($idiscussion=1; $idiscussion <=ceil($Discussions/SITEMAP_PAGE); $idiscussion++) { 
            echo '<sitemap>';
                echo '<loc>'.APP.'/sitemap.discussions_'.$idiscussion.'.xml</loc>';
                echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
            echo '</sitemap>';
        }
        // collections
        for ($icollection=1; $icollection <=ceil($Collections/SITEMAP_PAGE); $icollection++) { 
            echo '<sitemap>';
                echo '<loc>'.APP.'/sitemap.collections_'.$icollection.'.xml</loc>';
                echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
            echo '</sitemap>';
        }

        // categories
        for ($icategories=1; $icategories <=ceil($Categories/SITEMAP_PAGE); $icategories++) { 
            echo '<sitemap>';
                echo '<loc>'.APP.'/sitemap.categorias_'.$icategories.'.xml</loc>';
                echo '<lastmod>'.date("Y-m-d")."T".date("H:i:s").'+03:00</lastmod>';
            echo '</sitemap>';
        }
        echo '</sitemapindex>'; 
       

    }

}