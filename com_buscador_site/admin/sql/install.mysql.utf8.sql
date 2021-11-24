DROP TABLE IF EXISTS `#__buscador_site`;

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

INSERT INTO `#__buscador_site` (`name`,`profession`,`specialty`) VALUES
('Ramon','teleco','telemática'),
('Dani','teleco','telemática'),
('Pepe','farma','dispensar'),
('Raul','empresario','emprendimiento'),
('Jose','dirección','gasolineras'),
('Chris','ingeniería','minas'),
('Pili','ingeniería','mecánica'),
('Raquel','enseñanza','biología'),
('Socrates','ingeniería','informática'),
('Ursula','arte','pintura'),
('Julia','cocina','marisco'),
('Rocio','gestión informática','web');
