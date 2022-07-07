CREATE TABLE `url_links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `original_url` text NOT NULL,
  `shortened_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `url_links`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `url_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;