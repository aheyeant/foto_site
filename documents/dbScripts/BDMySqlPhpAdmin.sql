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
-- Create table "firms"
-- ---------------------------
DROP TABLE IF EXISTS `firms`;

CREATE TABLE `firms` (
    `id`    bigint                                 UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  varchar(255)                           NOT NULL UNIQUE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8;


-- ---------------------------
-- Create table "posts"
-- ---------------------------
DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
    `id`            bigint                         NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `model`         varchar(255)                   NOT NULL,
    `price`         int                            NOT NULL,
    `description`   text,
    `photo_url`     varchar(255)                   DEFAULT NULL,
    `available`     tinyint                        NOT NULL,
    `user_id`       bigint                         NOT NULL,
    `firm_id`       bigint                         NOT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8;
