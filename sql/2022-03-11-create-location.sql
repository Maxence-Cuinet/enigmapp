DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `description` varchar(250),
    `longitude` varchar(20) NOT NULL,
    `latitude` varchar(20) NOT NULL,
    `image` varchar(250),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;