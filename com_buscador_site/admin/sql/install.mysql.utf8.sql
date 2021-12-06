DROP TABLE IF EXISTS `#__buscador_site`;
DROP TABLE IF EXISTS `#__buscador_site_profession_list`;
DROP TABLE IF EXISTS `#__buscador_site_profession_specialty_map`;

CREATE TABLE `#__buscador_site` (
    `id`       		INT(11)         NOT NULL AUTO_INCREMENT,
    `name` 			VARCHAR(120)    NOT NULL,
    `profession`    VARCHAR(120)    NOT NULL DEFAULT '',
    `specialty`     VARCHAR(120)    NOT NULL DEFAULT '',
    `published`     tinyint(4)      NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE TABLE `#__buscador_site_profession_list` (
    `id`       		INT(11)         NOT NULL AUTO_INCREMENT,
    `profession`    VARCHAR(120)    NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE TABLE `#__buscador_site_profession_specialty_map` (
    `id`       		INT(11)         NOT NULL AUTO_INCREMENT,
    `profession`    VARCHAR(120)    NOT NULL DEFAULT '',
    `specialty`     VARCHAR(120)    NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO `#__buscador_site_profession_list` (`profession`) VALUES
('teleco'),
('farma'),
('empresario'),
('dirección'),
('ingeniería'),
('enseñanza'),
('arte'),
('cocina'),
('gestión informática');

INSERT INTO `#__buscador_site_profession_specialty_map` (`profession`,`specialty`) VALUES
('teleco','telemática'),
('teleco','comunicaciones'),
('farma','dispensar'),
('empresario','emprendimiento'),
('dirección','gasolineras'),
('ingeniería','minas'),
('ingeniería','informática'),
('enseñanza','biología'),
('arte','pintura'),
('cocina','marisco'),
('gestión informática','web');

INSERT INTO `#__buscador_site` (`name`,`profession`,`specialty`) VALUES
('Ramon','teleco','telemática'),
('Blanca','teleco','comunicaciones'),
('Dani','teleco','telemática'),
('Marcos','teleco','telemática'),
('Raul','teleco','comunicaciones'),
('Pepe','farma','dispensar'),
('Raul','empresario','emprendimiento'),
('Jose','dirección','gasolineras'),
('Chris','ingeniería','minas'),
('Pili','ingeniería','mecánica'),
('Socrates','ingeniería','informática'),
('Raquel','enseñanza','biología'),
('Ursula','arte','pintura'),
('Julia','cocina','marisco'),
('Rocio','gestión informática','web');
