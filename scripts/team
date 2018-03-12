DROP TABLE IF EXISTS team;

CREATE TABLE IF NOT EXISTS team (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	team_type_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id)
);

INSERT INTO team (name, team_type_id)
VALUES ('Brazil', 1),
		('Germany', 1),
		('Argentina', 1),
		('Portugal', 1),
		('Belgium', 1),
		('Spain', 1),
		('Poland', 1),
		('Egypt', 1),
		('Morocco', 1),
		('Nigeria', 1),
		('Senegal', 1),
		('Tunisia', 1),
		('Australia', 1),
		('IR Iran', 1),
		('Japan', 1),
		('Korea Republic', 1),
		('Saudi Arabia', 1),
		('Croatia', 1),
		('Denmark', 1),
		('England', 1),
		('France', 1),
		('Iceland', 1),
		('Russia', 1),
		('Serbia', 1),
		('Sweden', 1),
		('Switzerland', 1),
		('Costa Rica', 1),
		('Mexico', 1),
		('Panama', 1),
		('Colombia', 1),
		('Peru', 1),
		('Uruguay', 1);

DROP TRIGGER before_insert_team;
