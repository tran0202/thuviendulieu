CREATE TABLE IF NOT EXISTS tournament_type (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	team_type_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id)
);

INSERT INTO tournament_type (name, team_type_id)
VALUES ('FIFA World Cup', 1);
