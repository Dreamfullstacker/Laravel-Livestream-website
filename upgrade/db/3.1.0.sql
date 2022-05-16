INSERT INTO `modules` (`id`, `name`, `module_file`, `data`, `page`, `data_limit`, `sortable`, `status`) VALUES
(10, 'Recently Released Movies', 'home.moviesreleased', '{\"sorting\":\"create_year desc\",\"responsive\":\"horizontal\"}', 'home', 10, 9, 1),
(11, 'Recently Released Series', 'home.seriesreleased', '{\"sorting\":\"create_year desc\",\"responsive\":\"horizontal\"}', 'home', 10, 10, 1);


ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
