<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "TVSeries",
    "name": "<?php echo $Listing['title'];?>",
    "image": "<?php echo UPLOAD.'/cover/'.$Listing['image'];?>",
    "datePublished": "<?php echo date('Y-m-d');?>T23:04:34+03:00",
    <?php if(count($Actors) > 0) { ?>
    "actor": [
    <?php 
    $ii = 1;
    foreach ($Actors as $Actor) { ?>
      {
        "@type": "Person",
        "name": "<?php echo $Actor['name'];?>",
        "url": "<?php echo actor($Actor['actor_id'],$Actor['self']);?>"
    }
    <?php if($ii < count($Actors)) echo ',';?>
    <?php $ii++; } ?>],
    <?php } ?>
    "description": "<?php echo $Listing['description'];?>",
    "potentialAction": {
        "@type": "WatchAction",
        "target": "<?php echo post($Listing['id'],$Listing['self'],$Listing['type']);?>"
    },
    <?php if($Listing['country_name']) { ?>
    "countryOfOrigin": {
        "@type": "Country",
        "name": "<?php echo $Listing['country_name'];?>"
    },
    <?php } ?>
    <?php if($Listing['trailer']) { ?>
    "trailer": {
        "@type": "VideoObject",
        "name": "<?php echo $Listing['title'].' '.$Selected['season_name'].'.Sezon '.$Selected['episode_name'].'.Bölüm';?>",
        "description": "<?php echo $Listing['description'];?>",
        "thumbnailUrl": "<?php echo UPLOAD.'/cover/'.$Listing['image'];?>",
        "thumbnail": {
            "@type": "ImageObject",
            "contentUrl": "<?php echo UPLOAD.'/cover/'.$Listing['image'];?>"
        },
        "uploadDate": "<?php echo date('Y-m-d');?>T00:00:00+03:00",
        "embedUrl": "<?php echo $Listing['trailer'];?>",
        "duration": "PT<?php echo $Listing['duration'];?>M",
        "timeRequired": "PT<?php echo $Listing['duration'];?>M",
        "publisher": {
            "@type": "Organization",
            "name": "<?php echo get($Settings,'data.company','general');?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo LOCAL.'/'.get($Settings,'data.logo','general');?>"
            }
        },
        "interactionCount": "<?php echo $Listing['hit'];?>"
    },
    <?php } ?>
    "timeRequired": "PT<?php echo $Listing['duration'];?>M",
    "containsSeason": [
        <?php 
			$ii = 0;
			foreach ($Seasons as $Season) { ?> 
        	{
            "@type": "TVSeason",
            "seasonNumber": "<?php echo $Season['name'];?>",
            "episode": [
        	<?php 
			$Episodes = $this->db->from('posts_episode')
			->where('season_id',$Season['id'])
			->where('status',1)
			->where('content_id',$Listing['id'])
			->orderby('cast(name as unsigned)','ASC')
			->all();
			$iii = 0;
			foreach ($Episodes as $Episode) { ?>
            {
                "@type": "TVEpisode",
                "episodeNumber": "<?php echo $Episode['name'];?>",
                "name": "<?php echo ($Episode['description'] ? $Episode['description'] : $Episode['name'].'.Bölüm');?>",
                "datePublished": "2020-05-21T00:00:00+03:00",
                "url": "<?php echo episode($Listing['id'],$Listing['self'],$Season['name'],$Episode['name']);?>"
            }<?php if(++$iii != count($Episodes)) { echo ',';}?>
        	<?php } ?>
            ]
        }<?php if(++$ii != count($Seasons)) { echo ',';}?>
        <?php } ?>
    ],
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo $Listing['imdb'];?>",
        "bestRating": "10.0",
        "worstRating": "1.0",
        "ratingCount": "<?php echo $Listing['hit'];?>"
    },
    "director": {
        "@type": "Person",
        "name": "<?php echo get($Settings,'data.company','general');?>"
    },
    "review": {
        "@type": "Review",
        "author": {
            "@type": "Person",
            "name": "<?php echo get($Settings,'data.company','general');?>"
        },
        "datePublished": "<?php echo date('Y-m-d');?>:04:34+03:00",
        "reviewBody": "<?php echo $Listing['description'];?>"
    }
}
</script>