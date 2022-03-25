DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
    `id` int NOT NULL AUTO_INCREMENT,
    `question` varchar(250) NOT NULL,
    `image` varchar(250),
    `answer` varchar(250) NOT NULL,
    `possible_answers` json,
    `order` int NOT NULL,
    `score` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;