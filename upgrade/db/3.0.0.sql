INSERT INTO `modules` (`id`, `name`, `module_file`, `data`, `page`, `data_limit`, `sortable`, `status`) VALUES
(9, 'Chatbox', 'home.chatbox', '{\"sorting\":\"id desc\"}', 'home', 1, NULL, 1);

ALTER TABLE posts
  ADD mpaa varchar(255) DEFAULT NULL;
  
ALTER TABLE posts
  ADD end_year varchar(15) DEFAULT NULL;
  
  ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
