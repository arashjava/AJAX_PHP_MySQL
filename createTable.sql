A table created under the name "Projects" with five fields: CREATE TABLE `Projects` (
  `proj_id` int(6) NOT NULL AUTO_INCREMENT,
  `proj_name` varchar(50) DEFAULT NULL,
  `proj_site_owner` varchar(50) DEFAULT NULL,
  `proj_start_time` date DEFAULT NULL,
  `proj_expected_end_time` date DEFAULT NULL,
  `proj_end_time` date DEFAULT NULL,
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
