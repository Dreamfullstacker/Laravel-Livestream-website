CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `posts`
  ADD anime int(11) DEFAULT '2';

INSERT INTO `modules` (`id`, `name`, `module_file`, `data`, `page`, `data_limit`, `sortable`, `status`) VALUES
(14, 'Newest Anime', 'home.anime', '{\"sorting\":\"id desc\",\"responsive\":\"horizontal\"}', 'home', 10, 2, 1);

ALTER TABLE `modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
