CREATE TABLE `observations` (
  `date` datetime default NULL,
  `air_temp` double NOT NULL,
  `soil_temp_100` double NOT NULL,
  `soil_temp_30` double NOT NULL,
  `soil_temp_10` double NOT NULL,
  `grass_temp` double NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `idobservations_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7295 DEFAULT CHARSET=latin1;

