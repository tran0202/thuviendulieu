CREATE TABLE IF NOT EXISTS tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	start_date DATE,
	end_date DATE,
	tournament_type_id INT,
	FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id)
);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id)
VALUES ('FIFA World Cup Russia 2018', '2018-06-14', '2018-07-15', 1),
		('NFL Season 2018', '2018-08-03', '2019-02-04', 2);

ALTER TABLE tournament DROP FOREIGN KEY tournament_ibfk_1;

ALTER TABLE tournament
CHANGE team_type_id tournament_type_id INT

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_1`
FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id)
