CREATE TABLE IF NOT EXISTS `group` (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	long_name VARCHAR(255),
	group_type_id INT,
	FOREIGN KEY (group_type_id) REFERENCES group_type(id)
);

INSERT INTO `group` (name, long_name, group_type_id)
VALUES ('A', 'Group A', 1),
		('B', 'Group B', 1),
		('C', 'Group C', 1),
		('D', 'Group D', 1),
		('E', 'Group E', 1),
		('F', 'Group F', 1),
		('G', 'Group G', 1),
		('H', 'Group H', 1),
	('1', 'Group 1', 1),
	('2', 'Group 2', 1),
	('3', 'Group 3', 1),
	('4', 'Group 4', 1),
	('5', 'Group 5', 1),
	('6', 'Group 6', 1),
	('Withdrew', null, 1),
	('Final Round', null, 1);

INSERT INTO `group` (name, long_name, group_type_id)
VALUES ('League A', 'League A', 8),
	('League B', 'League B', 8),
	('League C', 'League C', 8),
	('League D', 'League D', 8);

INSERT INTO `group` (name, tournament_id, group_type_id)
VALUES ('AFC', 2, 2),
		('NFC', 2, 2),
		('East', 2, 3),
		('North', 2, 3),
		('South', 2, 3),
		('West', 2, 3),
		('East', 2, 3),
		('North', 2, 3),
		('South', 2, 3),
		('West', 2, 3);

INSERT INTO `group` (name, group_type_id)
VALUES ('First Stage', 4),
	('Second Stage', 4),
	('Group Matches', 5),
	('Round of 16', 5),
	('Quarterfinals', 5),
	('Semifinals', 5),
	('Third place', 5),
	('Final', 5),
	('Play-off', 5),
	('Final Round', 5),
	('Replay First Round', 5),
	('Preliminary Round', 5),
	('Replay Second Round', 5),
	('Replay Quarterfinals', 5),
	('Group Stage', 4),
	('MatchDay 1', 5),
	('MatchDay 2', 5),
	('MatchDay 3', 5),
	('MatchDay 4', 5),
	('MatchDay 5', 5),
	('MatchDay 6', 5);

INSERT INTO `group` (name, long_name, group_type_id)
VALUES ('Preseason', null, 4),
	('Regular Season', null, 4),
	('Post Season', null, 4),
	('HOF', 'Hall of Fame Week', 5),
	('Week 1', 'Week 1', 5),
	('Week 2', 'Week 2', 5),
	('Week 3', 'Week 3', 5),
	('Week 4', 'Week 4', 5),
	('Week 5', 'Week 5', 5),
	('Week 6', 'Week 6', 5),
	('Week 7', 'Week 7', 5),
	('Week 8', 'Week 8', 5),
	('Week 9', 'Week 9', 5),
	('Week 10', 'Week 10', 5),
	('Week 11', 'Week 11', 5),
	('Week 12', 'Week 12', 5),
	('Week 13', 'Week 13', 5),
	('Week 14', 'Week 14', 5),
	('Week 15', 'Week 15', 5),
	('Week 16', 'Week 16', 5),
	('Week 17', 'Week 17', 5),
	('Wild Card Weekend', 'Wild Card Weekend', 5),
	('Divisional Playoffs', 'Divisional Playoffs', 5),
	('Conference Championships', 'Conference Championships', 5),
	('Pro Bowl', 'Pro Bowl', 5),
	('Super Bowl', 'Super Bowl', 5);

INSERT INTO `group` (name, long_name, group_type_id)
VALUES ('First Round', 'Round of 128', 5),
	('Second Round', 'Round of 64', 5),
	('Third Round', 'Round of 32', 5),
	('Fourth Round', 'Round of 16', 5);

UPDATE `group`
SET name = SUBSTRING(name, 7, 1);

UPDATE `group`
SET group_type_id = 1;

SHOW INDEX FROM `group`;

DROP INDEX tournament_id ON `group`;

ALTER TABLE `group`
CHANGE tournament_id long_name CHAR(255);

ALTER TABLE `group`
MODIFY COLUMN long_name VARCHAR(255);

ALTER TABLE `group`
ADD COLUMN group_type_id INT;

ALTER TABLE `group`
ADD CONSTRAINT `group_ibfk_2`
FOREIGN KEY (group_type_id) REFERENCES group_type(id);

ALTER TABLE `group`
DROP FOREIGN KEY group_ibfk_2;

ALTER TABLE `group`
ADD UNIQUE (name);

DELETE FROM `group`
WHERE id >= 35;
