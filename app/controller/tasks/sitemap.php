<?php

include '../../config/db.config.php'; // Database configuration 

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM posts ORDER BY created DESC";
$sql2 = "SELECT * FROM categories";
$sql3 = "SELECT * FROM collections";
$sql4 = "SELECT * FROM pages";
$sql5 = "SELECT * FROM countries";
$sql6 = "SELECT * FROM actors";
$file = '../../../sitemap.xml';
$private = "2";
ob_start();

header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>1.00</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/register</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/login</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/discovery</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/movies</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/series</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/categories</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/countries</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.80</priority></url>";
echo "<url><loc>https://" . $_SERVER['SERVER_NAME'] . "/forgot-password</loc><lastmod>2021-05-06T23:23:07+00:00</lastmod><priority>0.64</priority></url>";    	

if ($result2 = mysqli_query($link, $sql2)) {
  if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_array($result2)) {
        echo "<url>";
        echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/category/" . $row2['self'] . "</loc>";
        echo "<priority>0.51</priority>";
        echo "</url>";
      }
   }
}
mysqli_free_result($result2);

if ($result3 = mysqli_query($link, $sql3)) {
  if (mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_array($result3)) {
        echo "<url>";
        echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/collection/" . $row3['self'] . "-" . $row3['id'] . "</loc>";
        echo "<priority>0.51</priority>";
        echo "</url>";
      }
   }
}
mysqli_free_result($result3);

if ($result4 = mysqli_query($link, $sql4)) {
  if (mysqli_num_rows($result4) > 0) {
    while ($row4 = mysqli_fetch_array($result4)) {
        echo "<url>";
        echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/page/" . $row4['self'] . "</loc>";
        echo "<priority>0.51</priority>";
        echo "</url>";
      }
   }
}
mysqli_free_result($result4);

if ($result5 = mysqli_query($link, $sql5)) {
  if (mysqli_num_rows($result5) > 0) {
    while ($row5 = mysqli_fetch_array($result5)) {
        $self = str_replace(' ', '-', strtolower($row5['name']));
        echo "<url>";
        echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/country/" . $self . "</loc>";
        echo "<priority>0.51</priority>";
        echo "</url>";
      }
   }
}
mysqli_free_result($result5);

if ($result5 = mysqli_query($link, $sql5)) {
  if (mysqli_num_rows($result5) > 0) {
    while ($row5 = mysqli_fetch_array($result5)) {
        $self = str_replace(' ', '-', strtolower($row5['name']));
        echo "<url>";
        echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/country/" . $self . "</loc>";
        echo "<priority>0.51</priority>";
        echo "</url>";
      }
   }
}
mysqli_free_result($result6);

if ($result6 = mysqli_query($link, $sql6)) {
  if (mysqli_num_rows($result6) > 0) {
    while ($row6 = mysqli_fetch_array($result6)) {
        $self = str_replace(' ', '-', strtolower($row6['name']));
        echo "<url>";
        echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/actors/" . $row6['self'] . '-' . $row6['id'] . "</loc>";
        echo "<priority>0.51</priority>";
        echo "</url>";
      }
   }
}
mysqli_free_result($result6);

if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      if ($row['private'] == $private) {
	 if(preg_match('/&/',$row['title'])){
   	   } else {
             echo "<url>";
             echo "<loc>https://" . $_SERVER['SERVER_NAME'] . "/" . $row['type'] . "/" . $row['self'] . "-" . $row['id'] . "</loc>";
             echo "<priority>0.51</priority>";
             echo "</url>";
           }
         }
       }
     mysqli_free_result($result);
  }
}
     echo "</urlset>";
$htmlStr = ob_get_contents();
ob_end_clean(); 
file_put_contents($file, $htmlStr);
mysqli_close($link);
?>
