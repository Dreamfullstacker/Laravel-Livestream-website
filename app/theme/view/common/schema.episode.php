<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "TVEpisode",
    "name": "<?php echo $Listing['title'].' '.$Selected['season_name'].'.Sezon '.$Selected['episode_name'].'.Bölüm';?>",
    "image": "<?php echo UPLOAD.'/cover/'.$Listing['image'];?>",
    "datePublished": "<?php echo date('Y-m-d');?>T00:00:00+03:00",
    "description": "<?php echo $Listing['description'];?>",
    "potentialAction": {
        "@type": "WatchAction",
        "target": "<?php echo episode($Listing['id'],$Listing['self'],$Selected['season_name'],$Selected['episode_name']);?>"
    },
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
        "interactionCount": "<?php echo $Listing['episode_hit'];?>"
    },
    <?php } ?>
    "timeRequired": "PT<?php echo $Listing['duration'];?>M",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo $Listing['imdb'];?>",
        "bestRating": "10.0",
        "worstRating": "1.0",
        "ratingCount": "<?php echo $Listing['hit'];?>"
    }
}
</script>