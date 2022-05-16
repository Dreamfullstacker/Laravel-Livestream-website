INSERT INTO `languages` (`id`, `name`, `short_name`, `language_code`, `text_direction`, `currency`, `language_order`, `status`) VALUES
(3, 'Indonesian', 'id', 'id-ID', 'ltr', 'IDR', 0, 0),
(4, 'Arabic', 'ar', 'ar-AR', 'rtl', 'AED', 0, 0);

ALTER TABLE users
  ADD chatboxban int(11) DEFAULT NULL;
  
ALTER TABLE reports
  ADD user varchar(255) DEFAULT NULL;
  
INSERT INTO `ads` (`id`, `name`, `type`, `ads_code`, `ads_data`, `display_admin`, `display_user`, `status`) VALUES
(8, 'In Feed Ads', '', '', '', 0, 0, 2);

ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
  
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
