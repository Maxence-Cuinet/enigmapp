DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
    `id` int NOT NULL AUTO_INCREMENT,
    `step_id` int NOT NULL,
    `libelle` text NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `url_img` text NOT NULL,
    `question` text NOT NULL,
    `answer_id` int NOT NULL,
    `course_id` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `question`;
DROP TABLE IF EXISTS `location`;