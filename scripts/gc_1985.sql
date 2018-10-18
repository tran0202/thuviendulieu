# Insert new tournament
# Replace all the tournament_id

# 1985 CONCACAF Championship

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule, points_for_win)
VALUES ('1985 CONCACAF Championship', '1985-02-24', '1985-09-14', 13, 'CONCACAF.png', null, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (143, 41, 1, 39, 1),
	   (143, 58, 2, 39, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO nation (name, flag_filename, nation_type_id, code)
# VALUES ('Guadeloupe', 'Guadeloupe.png', 7, 'GLP');
#
INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Suriname', 1, 181);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (197, 143, 1, 1),
	   (236, 143, 1, 2),
	   (973, 143, 1, 3),
	   (232, 143, 2, 1),
	   (968, 143, 2, 2),
	   (240, 143, 2, 3),
	   (27, 143, 3, 1),
	   (198, 143, 3, 2),
	   (211, 143, 3, 3);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (973, 0, 236, 3, 143, '1985-02-24', '190000', 1, 41, 39),
	   (236, 3, 973, 0, 143, '1985-02-27', '190000', 2, 41, 39),
	   (973, 1, 197, 1, 143, '1985-03-03', '190000', 3, 41, 39),
	   (197, 2, 973, 1, 143, '1985-03-06', '190000', 4, 41, 39),
	   (236, 1, 197, 2, 143, '1985-03-10', '190000', 5, 41, 39),
	   (197, 0, 236, 0, 143, '1985-03-14', '190000', 6, 41, 39),
	   (232, 2, 240, 0, 143, '1985-04-13', '190000', 7, 41, 39),
	   (232, 2, 968, 1, 143, '1985-04-20', '190000', 8, 41, 39),
	   (211, 0, 27, 3, 143, '1985-04-24', '190000', 9, 41, 39),
	   (240, 0, 968, 1, 143, '1985-04-26', '190000', 10, 41, 39),
	   (27, 1, 211, 1, 143, '1985-04-28', '190000', 11, 41, 39),
	   (968, 1, 232, 1, 143, '1985-05-05', '190000', 12, 41, 39),
	   (240, 0, 232, 2, 143, '1985-05-08', '190000', 13, 41, 39),
	   (968, 4, 240, 0, 143, '1985-05-15', '190000', 14, 41, 39),
	   (211, 1, 198, 2, 143, '1985-05-15', '190000', 15, 41, 39),
	   (198, 1, 211, 0, 143, '1985-05-19', '190000', 16, 41, 39),
	   (27, 1, 198, 1, 143, '1985-05-26', '190000', 17, 41, 39),
	   (198, 0, 27, 1, 143, '1985-05-31', '190000', 18, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id, group_id)
VALUES (27, 2, 197, 2, 143, '1985-08-11', '190000', 19, 58, 39, 58),
	   (232, 1, 27, 1, 143, '1985-08-17', '190000', 20, 58, 39, 58),
	   (197, 0, 232, 1, 143, '1985-08-25', '190000', 21, 58, 39, 58),
	   (27, 0, 232, 0, 143, '1985-09-01', '190000', 22, 58, 39, 58),
	   (197, 3, 27, 1, 143, '1985-09-08', '190000', 23, 58, 39, 58),
	   (232, 2, 197, 1, 143, '1985-09-14', '190000', 24, 58, 39, 58);

# INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
# 					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
# 					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
# VALUES (197, 2, null, null, 27, 0, null, null, 143, '1985-06-05', '190000', 13, 44, 40, 13),
# 	   (198, 2, null, null, 28, 0, null, null, 143, '1985-06-05', '190000', 14, 44, 40, 14),
# 	   (28, 2, null, null, 27, 0, null, null, 143, '1985-06-07', '190000', 15, 45, 40, 16),
# 	   (198, 0, 0, 4, 197, 0, 0, 3, 143, '1985-06-07', '190000', 16, 46, 40, 15);

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
	FOREIGN KEY (tournament_type_id) REFERENCES tournament_type(id),
	FOREIGN KEY (parent_tournament_id) REFERENCES tournament(id)
);

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

CREATE TABLE IF NOT EXISTS team_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT NOT NULL,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	parent_group_id INT,
	parent_group_order TINYINT UNSIGNED,
	seed TINYINT UNSIGNED,
	FOREIGN KEY (team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id),
	FOREIGN KEY (parent_group_id) REFERENCES `group`(id)
);

CREATE TABLE IF NOT EXISTS `match` (
	id INT AUTO_INCREMENT PRIMARY KEY,
	home_team_id INT,
	home_team_score TINYINT UNSIGNED,
	away_team_id INT,
	away_team_score TINYINT UNSIGNED,
	home_team_first_leg_score TINYINT UNSIGNED,
	away_team_first_leg_score TINYINT UNSIGNED,
	tournament_id INT NOT NULL,
	match_date DATE,
	match_time TIME,
	match_order SMALLINT UNSIGNED,
	bracket_order TINYINT UNSIGNED,
	waiting_home_team VARCHAR(255),
	waiting_away_team VARCHAR(255),
	home_team_extra_time_score TINYINT UNSIGNED,
	away_team_extra_time_score TINYINT UNSIGNED,
	home_team_penalty_score TINYINT UNSIGNED,
	away_team_penalty_score TINYINT UNSIGNED,
	round_id INT,
	round_order TINYINT UNSIGNED,
	stage_id INT,
	stage_order TINYINT UNSIGNED,
	group_id INT,
	home_retired TINYINT UNSIGNED,
	away_retired TINYINT UNSIGNED,
	home_set1_score TINYINT UNSIGNED,
	away_set1_score TINYINT UNSIGNED,
	home_set1_tiebreak TINYINT UNSIGNED,
	away_set1_tiebreak TINYINT UNSIGNED,
	home_set2_score TINYINT UNSIGNED,
	away_set2_score TINYINT UNSIGNED,
	home_set2_tiebreak TINYINT UNSIGNED,
	away_set2_tiebreak TINYINT UNSIGNED,
	home_set3_score TINYINT UNSIGNED,
	away_set3_score TINYINT UNSIGNED,
	home_set3_tiebreak TINYINT UNSIGNED,
	away_set3_tiebreak TINYINT UNSIGNED,
	home_set4_score TINYINT UNSIGNED,
	away_set4_score TINYINT UNSIGNED,
	home_set4_tiebreak TINYINT UNSIGNED,
	away_set4_tiebreak TINYINT UNSIGNED,
	home_set5_score TINYINT UNSIGNED,
	away_set5_score TINYINT UNSIGNED,
	home_set5_tiebreak TINYINT UNSIGNED,
	away_set5_tiebreak TINYINT UNSIGNED,
	FOREIGN KEY (home_team_id) REFERENCES team(id),
	FOREIGN KEY (away_team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (round_id) REFERENCES `group`(id),
	FOREIGN KEY (stage_id) REFERENCES `group`(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id)
);

CREATE TABLE IF NOT EXISTS group_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	parent_group_id INT,
	parent_group_order TINYINT UNSIGNED,
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id),
	FOREIGN KEY (parent_group_id) REFERENCES `group`(id)
);

CREATE TABLE IF NOT EXISTS nation (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	alternative_name VARCHAR(255),
	code VARCHAR(255),
	flag_filename VARCHAR(255),
	alternative_flag_filename VARCHAR(255),
	parent_nation_id INT,
	nation_type_id INT,
	FOREIGN KEY (parent_nation_id) REFERENCES nation(id),
	FOREIGN KEY (nation_type_id) REFERENCES group_type(id)
);
