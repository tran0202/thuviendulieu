CREATE TABLE IF NOT EXISTS tournament_type (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	team_type_id INT,
	sport_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id),
	FOREIGN KEY (sport_id) REFERENCES sport(id)
);

INSERT INTO tournament_type (name, team_type_id, sport_id)
VALUES ('FIFA World Cup', 1, 1),
		('Football Season', 6, 2);

ALTER TABLE tournament_type
ADD COLUMN sport_id INT;

ALTER TABLE tournament_type
ADD CONSTRAINT `tournament_type_ibfk_2`
FOREIGN KEY (sport_id) REFERENCES sport(id);

UPDATE tournament_type
SET sport_id = 2,
	team_type_id = 6
WHERE id = 2
