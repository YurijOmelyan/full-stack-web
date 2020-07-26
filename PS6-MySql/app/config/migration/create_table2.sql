CREATE TABLE ?table_name?
(
    `id`   BIGINT                                                        NOT NULL AUTO_INCREMENT,
    `date` TIMESTAMP                                                     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NOT NULL,
    `pass` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  CHARSET = utf8mb4
  COLLATE utf8mb4_unicode_ci COMMENT = 'users';