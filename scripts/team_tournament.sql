CREATE TABLE IF NOT EXISTS team_tournament (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT NOT NULL,
	tournament_id INT NOT NULL,
	group_id INT,
	group_order TINYINT UNSIGNED,
	FOREIGN KEY (team_id) REFERENCES team(id),
	FOREIGN KEY (tournament_id) REFERENCES tournament(id),
	FOREIGN KEY (group_id) REFERENCES `group`(id)
);

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

SELECT UCASE(t.name) AS name, team_id,
 	group_id, UCASE(g.name) AS group_name,
 	group_order, tt.tournament_id
FROM team_tournament tt 
LEFT JOIN team t ON t.id = tt.team_id
LEFT JOIN `group` g ON g.id = tt.group_id
WHERE tt.tournament_id = 1
ORDER BY group_id, group_order		
