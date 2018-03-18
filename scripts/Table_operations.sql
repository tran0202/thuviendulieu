CREATE TABLE IF NOT EXISTS TeamType (
	uuid CHAR(36) NOT NULL PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE
)

DROP TABLE IF EXISTS Team

RENAME TABLE TeamType TO team_type

INSERT INTO team (name, team_type_uuid)
VALUES ('Poland', '184d2659-257b-11e8-950c-feed01220059')

UPDATE team
SET team_type_uuid = '184d2659-257b-11e8-950c-feed01220059'

ALTER TABLE team
CHANGE team_uuid uuid CHAR(36) NOT NULL

ALTER TABLE team
ADD COLUMN team_type_uuid CHAR(36) NOT NULL

ALTER TABLE team
ADD CONSTRAINT `fk_team$team_type`
FOREIGN KEY (team_type_uuid) REFERENCES team_type(uuid)

CREATE TRIGGER before_insert_team
  	BEFORE INSERT ON team
  	FOR EACH ROW
  	SET new.uuid = uuid()

DROP TRIGGER before_insert_team