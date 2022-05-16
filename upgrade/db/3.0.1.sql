ALTER TABLE users
  ADD language varchar(255) DEFAULT NULL;

UPDATE `modules` SET `name` = 'Featured Actors' WHERE `modules`.`id` = 2;

ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
