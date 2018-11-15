CREATE TABLE IF NOT EXISTS tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	start_date DATE,
	end_date DATE,
	logo_filename VARCHAR(255),
	tournament_type_id INT,
	parent_tournament_id INT,
	points_for_win TINYINT UNSIGNED,
	golden_goal_rule TINYINT UNSIGNED,
	head_to_head_tiebreaker TINYINT UNSIGNED,
	third_place_ranking TINYINT UNSIGNED,
	FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id),
	FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id)
);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id)
VALUES ('2018 FIFA World Cup Russia', '2018-06-14', '2018-07-15', 1),
		('NFL Season 2018', '2018-08-03', '2019-02-04', 2),
		('2014 FIFA World Cup Brazil', '2014-06-12', '2014-07-13', 1);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2010 FIFA World Cup South Africa', '2010-06-11', '2010-07-11', 1, '2010.png'),
	('2006 FIFA World Cup Germany', '2006-06-09', '2006-07-09', 1, '2006.png'),
	('2002 FIFA World Cup Korea-Japan', '2002-05-31', '2002-06-20', 1, '2002.png'),
	('1998 FIFA World Cup France', '1998-06-10', '1998-07-12', 1, '1998.png'),
	('1994 FIFA World Cup USA', '1994-06-17', '1994-07-17', 1, '1994.png'),
	('1990 FIFA World Cup Italy', '1990-06-08', '1990-07-08', 1, '1990.png');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, points_for_win)
VALUES ('1986 FIFA World Cup Mexico', '1986-05-31', '1986-06-29', 1, '1986.png', 2),
	('1982 FIFA World Cup Spain', '1982-06-13', '1982-07-11', 1, '1982.png', 2),
	('1978 FIFA World Cup Argentina', '1978-06-01', '1978-06-25', 1, '1978.png', 2),
	('1974 FIFA World Cup Germany', '1974-06-13', '1974-07-07', 1, '1974.png', 2),
	('1970 FIFA World Cup Mexico', '1970-05-31', '1970-06-21', 1, '1970.png', 2),
	('1966 FIFA World Cup England', '1966-07-11', '1966-07-30', 1, '1966.png', 2),
	('1962 FIFA World Cup Chile', '1962-05-30', '1962-06-17', 1, '1962.png', 2),
	('1958 FIFA World Cup Sweden', '1958-06-08', '1958-06-29', 1, '1958.png', 2),
	('1954 FIFA World Cup Switzerland', '1954-06-16', '1954-07-04', 1, '1954.png', 2),
	('1950 FIFA World Cup Brazil', '1950-06-24', '1950-07-16', 1, '1950.png', 2),
	('1938 FIFA World Cup France', '1938-06-04', '1938-06-19', 1, '1938.png', 2),
	('1934 FIFA World Cup Italy', '1934-05-27', '1934-06-10', 1, '1934.png', 2),
	('1930 FIFA World Cup Uruguay', '1930-07-13', '1930-07-30', 1, '1930.png', 2);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2015 FIFA Women''s World Cup Canada', '2015-06-06', '2010-07-05', 8, '2015.png');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2011 FIFA Women''s World Cup Germany', '2011-06-26', '2010-07-17', 8, '2011.png');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('Olympic Football Tournament Rio 2016', '2016-08-03', '2016-08-20', 9, '2016.png'),
	   ('Women''s Olympic Football Tournament Rio 2016', '2016-08-03', '2016-08-20', 10, '2016.png');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2018/19 UEFA Nations League', '2018-09-06', '2019-06-09', 4, 'UEFA_Nations_League.png');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename)
VALUES ('2018/19 UEFA Champions League', '2018-06-26', '2019-06-01', 6, 'UCL.svg'),
	   ('2018/19 UEFA Europa League', '2018-06-28', '2019-05-29', 7, 'UEL.svg');

INSERT INTO tournament (name, start_date, end_date)
VALUES ('2017 US Open', '2017-08-28', '2017-09-10');

INSERT INTO tournament (name, start_date, end_date)
VALUES ('2018 US Open', '2018-08-27', '2017-09-09');

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, parent_tournament_id)
VALUES ('2017 US Open Men''s Singles', '2017-08-08', '2017-09-10', 3, 3),
	   ('2018 US Open Men''s Singles', '2018-08-27', '2018-09-09', 3, 26),
	   ('2018 US Open Women''s Singles', '2018-08-27', '2018-09-09', 5, 26);

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, parent_tournament_id)
VALUES ('2018 US Open Women''s Singles', '2018-08-27', '2018-09-09', 5, 26);

ALTER TABLE tournament
ADD COLUMN third_place_ranking TINYINT UNSIGNED
AFTER end_date;

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_2`
FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id);

ALTER TABLE tournament DROP FOREIGN KEY tournament_ibfk_1;

ALTER TABLE tournament
CHANGE goldenGoalRule golden_goal_rule TINYINT UNSIGNED;

ALTER TABLE tournament
ADD CONSTRAINT `tournament_ibfk_1`
FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id)
