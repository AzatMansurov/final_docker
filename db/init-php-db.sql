CREATE DATABASE IF NOT EXISTS `php`;

USE `php`;

CREATE TABLE IF NOT EXISTS `log` (
     `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `date_time` datetime NOT NULL,
     `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;