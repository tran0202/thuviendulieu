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
	('Football Season', 6, 2),
	('ATP Men''s Singles', 7, 3),
	   ('UEFA Nations League', 1, 1),
	   ('WTA Women''s Singles', 8, 3),
	   ('UEFA Champions League', 2, 1),
	   ('UEFA Europa League', 2, 1),
	   ('FIFA Women''s World Cup', 3, 1),
	   ('Olympic Football Tournament', 4, 1),
	   ('Women''s Olympic Football Tournament', 5, 1),
	   ('UEFA European Championship', 1, 1),
	   ('CONMEBOL Copa America', 1, 1),
	   ('CONCACAF Gold Cup', 1, 1),
	   ('CAF Africa Cup of Nations', 1, 1),
	   ('AFC Asian Cup', 1, 1),
	   ('OFC Nations Cup', 1, 1);

INSERT INTO tournament_type (name, team_type_id, sport_id)
VALUES ('FIFA Confederations Cup', 1, 1);

ALTER TABLE tournament_type
ADD COLUMN sport_id INT;

ALTER TABLE tournament_type
ADD CONSTRAINT `tournament_type_ibfk_2`
FOREIGN KEY (sport_id) REFERENCES sport(id);

UPDATE tournament_type
SET sport_id = 2,
	team_type_id = 6
WHERE id = 2
