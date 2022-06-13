DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `course_id` int(11) NOT NULL,
    `start_date` datetime NOT NULL,
    `end_date` datetime,
    `state` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;