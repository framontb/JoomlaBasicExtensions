-- DROP TABLES --
DROP TABLE IF EXISTS `#__ramajax_league_list`;
DROP TABLE IF EXISTS `#__ramajax_league_team_map`;

-- CREATE TABLE --
CREATE TABLE `#__ramajax_league_list` (
    `id`       		INT(11)         NOT NULL AUTO_INCREMENT,
    `league`    VARCHAR(120)    NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

-- CREATE TABLE --
CREATE TABLE `#__ramajax_league_team_map` (
    `id`       		INT(11)         NOT NULL AUTO_INCREMENT,
    `league`    VARCHAR(120)    NOT NULL DEFAULT '',
    `team`      VARCHAR(120)    NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

-- INSERT VALUES --
INSERT INTO `#__ramajax_league_list` (`league`) VALUES
('NBA'),
('LaLiga'),
('Serie A'),
('Premier');

-- INSERT VALUES --
INSERT INTO `#__ramajax_league_team_map` (`league`,`team`) VALUES
('','All'),
('NBA','Phoenix Suns'),
('NBA','Los Angeles Lakers'),
('NBA','Golden State Warriors'),
('LaLiga','Real Madrid'),
('LaLiga','Barcelona'),
('LaLiga','Celta'),
('Serie A','Juventus '),
('Serie A','Roma'),
('Serie A','Fiorentina'),
('Premier','Manchester United'),
('Premier','Chelsea'),
('Premier','Arsenal');
