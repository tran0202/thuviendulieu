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

SELECT * FROM `team` where team_type_id = 2 order by name;

# Tables to do: tournament_type, tournament, player, team_type, team, team_player, team_tournament, match

# 2018/19 UEFA Europa League

INSERT INTO `match` (home_team_id, home_team_score, home_team_first_leg_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_first_leg_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (733, 0, null, null, null, 686, 2, null, null, null, 30, '2018-06-26', null, 1, 109, 106, 0),
	   (676, 1, null, null, null, 721, 1, null, null, null, 30, '2018-06-28', null, 2, 109, 106, 0),
	   (658, 1, null, null, null, 700, 1, null, null, null, 30, '2018-06-28', null, 3, 109, 106, 0),
	   (661, 1, null, null, null, 749, 1, null, null, null, 30, '2018-06-28', null, 4, 109, 106, 0),
	   (653, 1, null, null, null, 744, 1, null, null, null, 30, '2018-06-28', null, 5, 109, 106, 0),
	   (675, 2, null, null, null, 681, 1, null, null, null, 30, '2018-06-28', null, 6, 109, 106, 0),
	   (751, 3, null, null, null, 654, 0, null, null, null, 30, '2018-06-28', null, 7, 109, 106, 0);

INSERT INTO `match` (home_team_id, home_team_score, home_team_first_leg_score, home_team_extra_time_score, home_team_penalty_score,
					 away_team_id, away_team_score, away_team_first_leg_score, away_team_extra_time_score, away_team_penalty_score,
					 tournament_id, match_date, match_time, match_order, round_id, stage_id, bracket_order)
VALUES (744, 1, 1, 0, 2, 653, 1, 1, 0, 4, 30, '2018-07-05', null, 8, 110, 106, 0),
	   (749, 1, 1, null, null, 661, 0, 1, null, null, 30, '2018-07-05', null, 9, 110, 106, 0),
	   (686, 2, 2, null, null, 733, 1, 0, null, null, 30, '2018-07-05', null, 10, 110, 106, 0),
	   (721, 5, 1, null, null, 676, 0, 1, null, null, 30, '2018-07-05', null, 11, 110, 106, 0),
	   (654, 1, 0, null, null, 751, 0, 3, null, null, 30, '2018-07-05', null, 12, 110, 106, 0),
	   (700, 2, 1, null, null, 658, 1, 1, null, null, 30, '2018-07-05', null, 13, 110, 106, 0),
	   (681, 1, 1, null, null, 675, 1, 2, null, null, 30, '2018-07-05', null, 14, 110, 106, 0);
