<?php
$DashboardNav = array(
array(
'name' => __('Dashboard'),
'icon' => 'fas fa-house',
'url' => 'admin',
'main' => 'main',
),

array(
'name' => __('Content'),
'url' => 'admin/content',
'main' => 'content',
'sub' => array(
//array(
//'name' => __('Movies'), 
//'url' => 'admin/movies',
//'main' => 'content',
//),
array(
'name' => __('Series'), 
'url' => 'admin/series',
'main' => 'content'
),
array(
'name' => __('Slider'), 
'url' => 'admin/slider',
'main' => 'content',
),
array(
'name' => __('Actors'), 
'url' => 'admin/actors',
'main' => 'content',
),
array(
'name' => __('Categories'), 
'url' => 'admin/categories',
'main' => 'content',
),
array(
'name' => __('Collections'), 
'url' => 'admin/collections',
'main' => 'content',
),
array(
'name' => __('Countries'),
'url' => 'admin/countries',
'main' => 'content'
),
array(
'name' => __('Pages'),
'url' => 'admin/pages',
'main' => 'content'
),
array(
'name' => __('Stories'), 
'url' => 'admin/stories',
'main' => 'content',
),
//array(
//'name' => __('TV Channels'), 
//'url' => 'admin/channels',
//'main' => 'content'
//), 
)
),

array(
'name' => __('Community'),
'url' => 'admin/community',
'main' => 'community',
'sub' => array(
array(
'name' => __('Users'), 
'url' => 'admin/users',
'main' => 'community',
),
array(
'name' => __('Comments'), 
'url' => 'admin/comments',
'main' => 'community',
),
array( 
'name' => __('Discussions'), 
'url' => 'admin/discussions',
'main' => 'community',
),
array(
'name' => __('Reports'),
'url' => 'admin/reports',
'main' => 'community',
),
array(
'name' => __('Requests'),
'url' => 'admin/requests',
'main' => 'community',
),
)
),

 array(
'name' => __('Tools'), 
'url' => 'admin/tools',
'main' => 'other',
),

array(
'name' => __('Settings'),
'url' => 'admin/settings',
'main' => 'settings',
'sub' => array(
array(
'name' => __('General'),
'url' => 'admin/settings',
'main' => 'settings'
),
array(
'name' => __('Advertisements'),
'url' => 'admin/ads',
'main' => 'settings'
),
array(
'name' => __('Languages'),
'url' => 'admin/languages',
'main' => 'settings'
),
array(
'name' => __('Video Options'),
'url' => 'admin/videos',
'main' => 'settings'
),
)
),

array(
'name' => __('Logout'),
'url' => 'logout',
'main' => 'logout',
),
);
