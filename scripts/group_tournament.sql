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

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES 	(1, 41, 1, 39, 1),
		(1, 42, 1, 40, 1),
		(1, 43, 2, 40, 2),
		(1, 44, 3, 40, 3),
		(1, 45, 4, 40, 4),
		(1, 46, 5, 40, 5),
	(5, 41, 1, 39, 1),
	(5, 42, 1, 40, 1),
	(5, 43, 2, 40, 2),
	(5, 44, 3, 40, 3),
	(5, 45, 4, 40, 4),
	(5, 46, 5, 40, 5),
	(6, 41, 1, 39, 1),
	(6, 42, 1, 40, 1),
	(6, 43, 2, 40, 2),
	(6, 44, 3, 40, 3),
	(6, 45, 4, 40, 4),
	(6, 46, 5, 40, 5);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES 	(7, 41, 1, 39, 1),
	(7, 42, 1, 40, 1),
	(7, 43, 2, 40, 2),
	(7, 44, 3, 40, 3),
	(7, 45, 4, 40, 4),
	(7, 46, 5, 40, 5);
