CREATE TABLE `station_data` (
  `id` int(11) NOT NULL auto_increment,
  `dateutc` datetime default NULL,
  `windgustmph` double default NULL,
  `tempf` double default NULL,
  `windspeedmph` double default NULL,
  `baromin` double default NULL,
  `rainin` double default NULL,
  `dailyrainin` double default NULL,
  `winddir` int(11) default NULL,
  `dewptf` double default NULL,
  `humidity` int(11) default NULL,
  `key` varchar(45) default NULL,
  `softwaretype` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1287 DEFAULT CHARSET=latin1;

