DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(20) NOT NULL,
    `longitude` varchar(100) NOT NULL,
    `latitude` varchar(100) NOT NULL,
    `description` varchar(100),
    `img` varchar(100),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;