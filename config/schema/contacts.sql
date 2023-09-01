USE crud_data;

CREATE TABLE IF NOT EXISTS `contacts` (
    `id` VARCHAR(41) PRIMARY KEY CHECK (`id` REGEXP '^[a-zA-Z0-9]+$'),
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `age` INT NOT NULL,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DELIMITER $$
CREATE TRIGGER `contacts_before_insert` BEFORE INSERT ON `contacts`
FOR EACH ROW BEGIN
    DECLARE ready INT DEFAULT 0;
    DECLARE rnd_str text;
    WHILE NOT ready DO
        SET rnd_str := substring(concat(md5(rand()), md5(rand())), 1, 41);
        if NOT EXISTS (select 1 from `contacts` where `id` = rnd_str) then
            SET NEW.id = rnd_str;
            SET ready := 1;
        END if;
    END WHILE;

END;$$
DELIMITER ;