# Insert new tournament
# Replace all the tournament_id

# Euro 1988 West Germany

INSERT INTO tournament (name, start_date, end_date, tournament_type_id, logo_filename, golden_goal_rule)
VALUES ('UEFA Euro 1988 West Germany', '1988-06-10', '1988-06-25', 11, 'Euro_1988.png', null);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (75, 41, 1, 39, 1),
	   (75, 44, 1, 40, 1),
	   (75, 46, 2, 40, 2);

SELECT * FROM `team` WHERE team_type_id = 1 ORDER BY name;

# INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
# VALUES ('CIS', 1, 228, 23);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (231, 75, 1, 1),
	   (203, 75, 1, 2),
	   (6, 75, 1, 3),
	   (19, 75, 1, 4),
	   (228, 75, 2, 1),
	   (204, 75, 2, 2),
	   (217, 75, 2, 3),
	   (20, 75, 2, 4);

INSERT INTO `match` (home_team_id, home_team_score, away_team_id, away_team_score, tournament_id, match_date, match_time, match_order, round_id, stage_id)
VALUES (231, 1, 203, 1, 75, '1988-06-10', '201500', 1, 41, 39),
	   (19, 2, 6, 3, 75, '1988-06-11', '153000', 2, 41, 39),
	   (20, 0, 217, 1, 75, '1988-06-12', '153000', 3, 41, 39),
	   (204, 0, 228, 1, 75, '1988-06-12', '201500', 4, 41, 39),
	   (231, 2, 19, 0, 75, '1988-06-14', '171500', 5, 41, 39),
	   (203, 1, 6, 0, 75, '1988-06-14', '201500', 6, 41, 39),
	   (20, 1, 204, 3, 75, '1988-06-15', '171500', 7, 41, 39),
	   (217, 1, 228, 1, 75, '1988-06-15', '201500', 8, 41, 39),
	   (231, 2, 6, 0, 75, '1988-06-17', '201500', 9, 41, 39),
	   (203, 2, 19, 0, 75, '1988-06-17', '201500', 10, 41, 39),
	   (20, 1, 228, 3, 75, '1988-06-18', '153000', 11, 41, 39),
	   (217, 0, 204, 1, 75, '1988-06-18', '153000', 12, 41, 39);

INSERT INTO `match` (home_team_id, home_team_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (231, 1, null, null, 204, 2, null, null, 75, '1988-06-21', '201500', 13, 44, 40, 14),
	   (228, 2, null, null, 203, 0, null, null, 75, '1988-06-22', '201500', 14, 44, 40, 13),
	   (228, 0, null, null, 204, 2, null, null, 75, '1988-06-25', '153000', 15, 46, 40, 15);

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
	parent_team_id INT,
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
