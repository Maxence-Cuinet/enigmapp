DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
    `id` int NOT NULL AUTO_INCREMENT,
    `question` varchar(250) NOT NULL,
    `answer` varchar(250) NOT NULL,
    `possibleAnswers` json,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;