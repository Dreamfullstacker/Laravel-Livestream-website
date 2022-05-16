ALTER TABLE reports
  ADD url varchar(255) DEFAULT NULL;
  
ALTER TABLE comments
  ADD url varchar(255) DEFAULT NULL;
  
ALTER TABLE collections
  ADD featuredplaylist int(8) DEFAULT NULL,
  ADD featuredservice int(8) DEFAULT NULL,
  ADD playlist int(8) DEFAULT NULL,
  ADD service int(8) DEFAULT NULL;

INSERT INTO `modules` (`id`, `name`, `module_file`, `data`, `page`, `data_limit`, `sortable`, `status`) VALUES
(12, 'Featured Playlists', 'home.playlists', '{\"sorting\":\"id desc\",\"responsive\":\"horizontal\"}', 'home', 3, 3, 1),
(13, 'Featured Services', 'home.services', '{\"sorting\":\"id desc\",\"responsive\":\"horizontal\"}', 'home', 3, 3, 1);

ALTER TABLE `modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
