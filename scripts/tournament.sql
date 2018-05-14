CREATE TABLE IF NOT EXISTS tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	start_date DATE,
	end_date DATE,
	logo_filename VARCHAR(255),
	tournament_type_id INT,
	parent_tournament_id INT,
	FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id),
	FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id)
);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id)
VALUES ('2018 FIFA World Cup Russia', '2018-06-14', '2018-07-15', 1),
		('NFL Season 2018', '2018-08-03', '2019-02-04', 2),
		('2014 FIFA World Cup Brazil', '2014-06-12', '2014-07-13', 1);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2010 FIFA World Cup South Africa', '2010-06-11', '2010-07-11', 1, '2010.png'),
	('2006 FIFA World Cup Germany', '2006-06-09', '2006-07-09', 1, '2006.png');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2002 FIFA World Cup Korea/Japan', '2002-05-31', '2002-06-20', 1, '2002.png');

INSERT INTO tournament (name, start_date, end_date)
VALUES ('2017 US Open', '2017-08-28', '2017-09-10');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, parent_tournament_id)
VALUES ('2017 US Open Men''s Singles', '2018-06-14', '2018-07-15', 3, 3);

ALTER TABLE tournament
ADD COLUMN logo_filename VARCHAR(255);

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_2`
FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id);

ALTER TABLE tournament DROP FOREIGN KEY tournament_ibfk_1;

ALTER TABLE tournament
CHANGE team_type_id tournament_type_id INT

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_1`
FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id)
