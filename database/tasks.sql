CREATE TABLE `t_tasks` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(255) NOT NULL ,
`email` VARCHAR(255) NOT NULL ,
`body` TEXT NOT NULL ,
`image` VARCHAR(255) NOT NULL DEFAULT '' ,
`status` TINYINT(1) NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `t_managers` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`login` VARCHAR(255) NOT NULL ,
`password` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `t_managers` (`login`, `password`) VALUES ('admin', 'd7c78d8a011eebee3ac3147f19ef5ac2');
