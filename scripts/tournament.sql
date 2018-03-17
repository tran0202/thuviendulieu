CREATE TABLE IF NOT EXISTS tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	start_date DATE,
	end_date DATE,
	tournament_type_id INT,
	parent_tournament_id INT,
	FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id),
	FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id)
);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id)
VALUES ('FIFA World Cup Russia 2018', '2018-06-14', '2018-07-15', 1),
		('NFL Season 2018', '2018-08-03', '2019-02-04', 2);

INSERT INTO tournament (name, start_date, end_date)
VALUES ('2017 US Open', '2017-08-28', '2017-09-10');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, parent_tournament_id)
VALUES ('2017 US Open Men''s Singles', '2018-06-14', '2018-07-15', 3, 3);

ALTER TABLE tournament
ADD COLUMN parent_tournament_id INT;

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_2`
FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id);

ALTER TABLE tournament DROP FOREIGN KEY tournament_ibfk_1;

ALTER TABLE tournament
CHANGE team_type_id tournament_type_id INT

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_1`
FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id)
