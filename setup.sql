

CREATE TABLE IF NOT EXISTS `daten` (
  `id` int(11) NOT NULL,
  `sensor` varchar(100) NOT NULL,
  `data` varchar(100) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT DEFAULT CHARSET=latin1;

ALTER TABLE `daten`
  ADD PRIMARY KEY (`id`);


