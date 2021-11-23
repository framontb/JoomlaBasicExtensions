DROP TABLE IF EXISTS `#__buscador_site`;

CREATE TABLE `#__buscador_site` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`greeting` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO `#__buscador_site` (`greeting`) VALUES
('Hello World!'),
('saludo 1!'),
('saludo 2!'),
('saludo 3!'),
('saludo 4!'),
('saludo 5!'),
('saludo 6!'),
('saludo 7!'),
('saludo 8!'),
('saludo 9!'),
('saludo 10!'),
('Good bye World!');
