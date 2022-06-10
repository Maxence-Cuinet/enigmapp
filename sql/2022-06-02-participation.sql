DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_user` int(11) NOT NULL,
    `id_course` int(11) NOT NULL,
    `date_start` datetime NOT NULL,
    `date_end` datetime NOT NULL,
    `state` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;