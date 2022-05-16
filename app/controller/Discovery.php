<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Discovery extends Controller
{
public function process()
{
$AuthUser   = $this->getVariable("AuthUser");
$Route  = $this->getVariable("Route");
$Settings   = $this->getVariable("Settings");
$Config['nav']  = 'discovery';
$Categories = $this->db->from('categories')->orderby('name','ASC')->all();

if($_POST['_ACTION'] == 'filter') {
foreach ($_POST as $key => $value) {
if($value AND $key != '_ACTION') {
$Filter[$key] = trim($value);
}
}
if(count($Filter) > 0) {
header("location: ".APP.'/discovery?filter='.json_encode($Filter));
} else {
header("location: ".APP.'/discovery');
}
}
$Filter = json_decode($_GET['filter'], true);
if($Filter['sorting'] == 'popular') {
$OrderBy = 'ORDER BY posts.hit DESC';
}elseif($Filter['sorting'] == 'newest') {
$OrderBy = 'ORDER BY posts.id DESC';
}elseif($Filter['sorting'] == 'featured') {
$OrderBy = 'ORDER BY posts.id ASC';
}elseif($Filter['sorting'] == 'released') {
$OrderBy = 'ORDER BY posts.create_year DESC';
}elseif($Filter['sorting'] == 'imdb') {
$OrderBy = 'ORDER BY posts.imdb DESC';
}else{
$OrderBy = 'ORDER BY posts.id DESC';
}
if($Filter['quality']) {
$Where .= 'posts.quality = "'.Input::cleaner($Filter['quality']).'" AND ';
}
if($Filter['type']) {
$Where .= 'posts.type = "'.Input::cleaner($Filter['type']).'" AND ';
}
if($Filter['category']) {
$Where .= 'posts_category.category_id = "'.Input::cleaner($Filter['category']).'" AND ';
$Join  .= 'LEFT JOIN posts_category ON posts_category.content_id = posts.id';
}
if($Filter['imdb']) {
$Where .= 'posts.imdb >= "'.Input::cleaner($Filter['imdb']).'" AND ';
}
if($Filter['released']) {
$YearExplode = explode('-',Input::cleaner($Filter['released']));
$Where .= 'posts.create_year BETWEEN '.$YearExplode[0].' AND '.$YearExplode[1].' AND ';
}
$Where = 'WHERE posts.status = "1" AND '.$Where;
$Where = rtrim($Where,' AND ');

if(count($Where) > 0) {
$SearchPage = '?filter='.json_encode($Filter).'&';
} else {
$SearchPage = '?';
}
// Query
$TotalRecord= $this->db->from(null,'
SELECT
COUNT(posts.id) as total
FROM `posts`
'.$Join.'
'.$Where.'')
->total();
$LimitPage  = $this->db->pagination($TotalRecord, PAGE_LIMIT, PAGE_PARAM);

$Listings = $this->db->from(null,'
SELECT
posts.id,
posts.title,
posts.title_sub,
posts.image,
posts.self,
posts.imdb,
posts.type,
posts.quality,
posts.create_year,
posts.end_year,
posts.mpaa,
posts.description,
posts.status,
posts.created,
categories.name
FROM `posts`
LEFT JOIN posts_category ON posts_category.content_id = posts.id
LEFT JOIN categories ON categories.id = posts_category.category_id
'.$Where.'
GROUP BY posts.id
'.$OrderBy.'
LIMIT '.$LimitPage['start'].','.$LimitPage['limit'])
->all();
$Pagination = $this->db->showPagination(APP.'/discovery'.$SearchPage.'page=[page]');
$Config['title']= get($Settings, "data.discovery_title", "seo");
$Config['description']  = get($Settings, "data.discovery_description", "seo");
$Config['url']  = APP.'/discovery';
$this->setVariable('Listings', $Listings);
$this->setVariable('Pagination', $Pagination);
$this->setVariable('TotalRecord', $TotalRecord);
$this->setVariable('Categories', $Categories);
$this->setVariable('Countries', $Countries);
$this->setVariable("Config", $Config);
$this->setVariable("Filter", $Filter);
$this->view('discovery', 'app');
}
}
