CREATE TABLE IF NOT EXISTS TeamType (
	uuid CHAR(36) NOT NULL PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS Team;

RENAME TABLE TeamType TO team_type;

INSERT INTO team (name, team_type_uuid)
VALUES ('Poland', '184d2659-257b-11e8-950c-feed01220059');

UPDATE team
SET team_type_uuid = '184d2659-257b-11e8-950c-feed01220059';

ALTER TABLE team
CHANGE team_uuid uuid CHAR(36) NOT NULL;

ALTER TABLE `match`
	ADD COLUMN home_seed TINYINT UNSIGNED,
	ADD COLUMN away_seed TINYINT UNSIGNED;

ALTER TABLE team
ADD CONSTRAINT `fk_team$team_type`
FOREIGN KEY (team_type_uuid) REFERENCES team_type(uuid);

ALTER TABLE table
	DROP COLUMN column_1,
	DROP COLUMN column_2;

CREATE TRIGGER before_insert_team
  	BEFORE INSERT ON team
  	FOR EACH ROW
  	SET new.uuid = uuid();

DROP TRIGGER before_insert_team;

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

SELECT * FROM `team_tournament` WHERE tournament_id = 1;

SELECT * FROM `match` WHERE tournament_id = 1;

SELECT * FROM `team`
WHERE nation_id IS NOT null
AND (team_type_id = 1 OR team_type_id = 3 OR team_type_id = 4 OR team_type_id = 5)
ORDER BY nation_id;
