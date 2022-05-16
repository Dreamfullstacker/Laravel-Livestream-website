<?php
include '../app/config/db.config.php'; // Database configuration 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$result = $conn->query('
SELECT posts.id as postid, posts.title, posts.type, posts_episode.created, posts.self, posts.image, posts.private, posts_video.content_id, posts_video.embed, posts_video.download as download, posts_video.episode_id, posts_episode.content_id, posts_episode.name as episodename, posts_episode.id, posts_season.id, posts_episode.season_id, posts_season.name as seasonname
FROM
posts
INNER JOIN
posts_video ON posts.id=posts_video.content_id
INNER JOIN
posts_episode ON posts_episode.id=posts_video.episode_id
INNER JOIN
posts_season ON posts_season.id=posts_episode.season_id
ORDER BY created DESC LIMIT 15
');

$private = "2";
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<rss version='2.0'>";
echo "<channel>";
echo "<title>Episodios mais recentes RSS Feed</title>";
echo "<link>https://" . $_SERVER['SERVER_NAME'] . "</link>";
echo "<language>pt-br</language>";
while ($row = $result->fetch_assoc())
{
if(preg_match('/curso/',$row['type'])){
if ($row['private'] == $private) 
{
if(preg_match('/&/',$row['title'])){ 
} 
else {
echo "<item>";
echo "<title>" . $row['title'] . ": Season ". $row['seasonname'] . " - Episode " . $row['episodename'] . "</title>";
echo "<link>https://" . $_SERVER['SERVER_NAME'] . "/" . $row['type'] . "/" . $row['self'] . "-" . $row['postid'] . "-" . $row['seasonname'] . "-season-" . $row['episodename'] . "-episode</link>";
echo "<description>Watch " . $row['title'] . ": Season ". $row['seasonname'] . " - Episode " . $row['episodename'] . " for free at Watch A Movie, a new place to watch Movies and TV Shows for free!</description>";
echo "<enclosure url='https://" . $_SERVER['SERVER_NAME'] . "/public/upload/cover/" . $row['image'] . "' length='174093' type='image/webp'/>";
echo "<pubDate>" . $row['created'] . "</pubDate>";
echo "</item>";
}
}
}
}
echo "</channel>";
echo "</rss>";
mysqli_free_result($result);
?>
