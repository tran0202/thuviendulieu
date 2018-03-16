CREATE TABLE IF NOT EXISTS team_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT NOT NULL,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	parent_group_id INT,
	parent_group_order TINYINT UNSIGNED,
	FOREIGN KEY (team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id),
	FOREIGN KEY (parent_group_id) REFERENCES `group`(id)
);

ALTER TABLE team_tournament
ADD COLUMN parent_group_id INT;

ALTER TABLE team_tournament
ADD CONSTRAINT `team_tournament_ibfk_4`
FOREIGN KEY (parent_group_id) REFERENCES `group`(id);

ALTER TABLE team_tournament
ADD COLUMN parent_group_order TINYINT UNSIGNED;

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order)
VALUES (3, 1, 4, 1),
		(23, 1, 1, 1),
		(17, 1, 1, 2),
		(8, 1, 1, 3),
		(32, 1, 1, 4),
		(4, 1, 2, 1),
		(6, 1, 2, 2),
		(9, 1, 2, 3),
		(14, 1, 2, 4),
		(21, 1, 3, 1),
		(13, 1, 3, 2),
		(31, 1, 3, 3),
		(19, 1, 3, 4),
		(22, 1, 4, 2),
		(18, 1, 4, 3),
		(10, 1, 4, 4),
		(1, 1, 5, 1),
		(26, 1, 5, 2),
		(27, 1, 5, 3),
		(24, 1, 5, 4),
		(2, 1, 6, 1),
		(28, 1, 6, 2),
		(25, 1, 6, 3),
		(16, 1, 6, 4),
		(5, 1, 7, 1),
		(29, 1, 7, 2),
		(12, 1, 7, 3),
		(20, 1, 7, 4),
		(7, 1, 8, 1),
		(11, 1, 8, 2),
		(30, 1, 8, 3),
		(15, 1, 8, 4);

INSERT INTO team_tournament (team_id, tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES 	(53, 2, 31, 1, 29, 1),
		(36, 2, 31, 2, 29, 2),
		(51, 2, 31, 3, 29, 3),
		(56, 2, 31, 4, 29, 4),
		(59, 2, 32, 1, 29, 5),
		(35, 2, 32, 2, 29, 6),
		(39, 2, 32, 3, 29, 7),
		(40, 2, 32, 4, 29, 8),
		(47, 2, 33, 1, 29, 9),
		(63, 2, 33, 2, 29, 10),
		(46, 2, 33, 3, 29, 11),
		(45, 2, 33, 4, 29, 12),
		(48, 2, 34, 1, 29, 13),
		(49, 2, 34, 2, 29, 14),
		(57, 2, 34, 3, 29, 15),
		(42, 2, 34, 4, 29, 16),
		(58, 2, 31, 1, 30, 1),
		(41, 2, 31, 2, 30, 2),
		(64, 2, 31, 3, 30, 3),
		(55, 2, 31, 4, 30, 4),
		(52, 2, 32, 1, 30, 5),
		(43, 2, 32, 2, 30, 6),
		(44, 2, 32, 3, 30, 7),
		(38, 2, 32, 4, 30, 8),
		(54, 2, 33, 1, 30, 9),
		(37, 2, 33, 2, 30, 10),
		(34, 2, 33, 3, 30, 11),
		(62, 2, 33, 4, 30, 12),
		(50, 2, 34, 1, 30, 13),
		(61, 2, 34, 2, 30, 14),
		(33, 2, 34, 3, 30, 15),
		(60, 2, 34, 4, 30, 16);

SELECT t.name AS name, team_id,
 	group_id, g.name AS group_name,	group_order, 
 	parent_group_id, pg.name AS parent_group_name, parent_group_order,
 	tt.tournament_id
FROM team_tournament tt 
LEFT JOIN team t ON t.id = tt.team_id
LEFT JOIN `group` g ON g.id = tt.group_id
LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
WHERE tt.tournament_id = 2
ORDER BY parent_group_name, group_id, group_order		
