CREATE TABLE IF NOT EXISTS team (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	team_type_id INT,
	nation_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id),
	FOREIGN KEY (nation_id) REFERENCES nation(id),
	FOREIGN KEY (parent_team_id) REFERENCES team(id),
	code VARCHAR(255),
	short_name VARCHAR(255),
	official_name VARCHAR(255)
);

# Women's Olympic

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Brazil', 5, 28), ('China PR', 5, 42), ('Sweden', 5, 183), ('South Africa', 5, 173),
	   ('Canada', 5, 36), ('Germany', 5, 76), ('Australia', 5, 12), ('Zimbabwe', 5, 211),
	   ('USA', 5, 203), ('France', 5, 71), ('New Zealand', 5, 137), ('Colombia', 5, 44);
