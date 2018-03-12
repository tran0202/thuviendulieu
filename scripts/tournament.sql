CREATE TABLE IF NOT EXISTS tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	start_date DATE,
	end_date DATE,
	team_type_id INT,
	FOREIGN KEY (team_type_id) REFERENCES team_type(id)
);

INSERT INTO tournament (name, start_date, end_date, team_type_id)
VALUES ('FIFA World Cup Russia 2018', '2018-06-14', '2018-07-15', 1);
