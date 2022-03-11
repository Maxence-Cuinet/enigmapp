DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(20) NOT NULL,
    `created_at` DateTime,
    `updated_at` DateTime,
    PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;