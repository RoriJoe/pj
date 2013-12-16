DROP TABLE tt_resetperkiraan;

CREATE TABLE `tt_resetperkiraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dari` varchar(10) NOT NULL,
  `sampai` varchar(10) NOT NULL,
  `tahun` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

INSERT INTO tt_resetperkiraan VALUES("35","1.2.01","1.2.04","0");



