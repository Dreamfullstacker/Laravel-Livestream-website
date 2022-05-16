ALTER TABLE posts
  ADD series_status varchar(15) DEFAULT NULL;
  
ALTER TABLE posts
  ADD politicy int(1) DEFAULT NULL;

ALTER TABLE users
  ADD chatboxbanreason varchar(255) DEFAULT NULL;

INSERT INTO `languages` (`id`, `name`, `short_name`, `language_code`, `text_direction`, `currency`, `language_order`, `status`) VALUES
(5, 'Dutch', 'nl', 'nl-NL', 'ltr', 'EUR', 0, 0);

ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

UPDATE `settings` SET `data` = '{\"movies_title\":\"${title} Movie Recommendations\",\"movies_description\":\"${title} Watch movies in HD quality with language options with dubbing and subtitles.\",\"movies_category_title\":\"${title} Movie Recommendations\",\"movies_category_description\":\"Best ${title} Watch movies in HD quality with language options with dubbing and subtitles.\",\"movie_title\":\"${title} Movie free watch\",\"movie_description\":\"${title} watch your movie in HD quality fast and uninterrupted\",\"series_title\":\"${title} Serie Recommendations\",\"series_description\":\"${title} Watch series in HD quality with language options with dubbing and subtitles.\",\"series_category_title\":\"${title} Serie Recommendations\",\"series_category_description\":\"Best ${title} Watch series in HD quality with language options with dubbing and subtitles.\",\"serie_title\":\"${title} Season ${season}: Episode ${episode} HD watch\",\"serie_description\":\"${title} ${season}.Season ${episode}.Episode HD watch\",\"serie_profile_title\":\"${title} Serie free watch\",\"serie_profile_description\":\"${title} watch your serie in HD quality fast and uninterrupted\",\"category_title\":\"${title} Serie and Movie Recommendations\",\"category_description\":\"${title} Watch series and movies in HD quality with language options with dubbing and subtitles.\",\"actor_title\":\"${title} Watch the actor\'s movies and series\",\"actor_description\":\"${title} Watch the movies and TV series the actor has played in full HD\",\"discovery_title\":\"Dubbed and Subtitled Series & Movies Explore and Watch\",\"discovery_description\":\"Discover the best dubbing, subtitled TV series and movies with advanced filters and watch them in 1080p quality.\",\"channels_title\":\"Popular TV Channels Online watch\",\"channels_description\":\"Popular TV Channels Online watch streaming\",\"channel_title\":\"${title} TV Channel Online watch streaming\",\"channel_description\":\"${title} TV Channel Online watch streaming\",\"anime_title\":\"${title} Anime Recommendations\",\"anime_description\":\"${title} Watch anime in HD quality with language options with dubbing and subtitles.\",\"anime_category_title\":\"${title} Anime Recommendations\",\"anime_category_description\":\"Best ${title} Watch anime in HD quality with language options with dubbing and subtitles.\",\"anime_profile_title\":\"${title} Anime free watch\",\"anime_profile_description\":\"${title} watch your anime in HD quality fast and uninterrupted\"}' WHERE `settings`.`id` = 5;
