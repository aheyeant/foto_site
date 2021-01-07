-- ---------------------------
-- Create table "users"
-- ---------------------------
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id`       bigint UNSIGNED                     NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(65)                         NOT NULL UNIQUE,
    `email`    varchar(255)                        NOT NULL UNIQUE,
    `password` varchar(255)                        NOT NULL,
    `phone`    varchar(25) DEFAULT NULL,
    `role`     enum ('ROLE_USER','ROLE_ADMIN')     NOT NULL,
    `verified` tinyint                             NOT NULL,
    `blocked`  tinyint                             NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


-- ---------------------------
-- Create table ""
-- ---------------------------


