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
	(6, 46, 5, 40, 5),
	(7, 41, 1, 39, 1),
	(7, 42, 1, 40, 1),
	(7, 43, 2, 40, 2),
	(7, 44, 3, 40, 3),
	(7, 45, 4, 40, 4),
	(7, 46, 5, 40, 5),
	(8, 41, 1, 39, 1),
	(8, 42, 1, 40, 1),
	(8, 43, 2, 40, 2),
	(8, 44, 3, 40, 3),
	(8, 45, 4, 40, 4),
	(8, 46, 5, 40, 5),
	(9, 41, 1, 39, 1),
	(9, 42, 1, 40, 1),
	(9, 43, 2, 40, 2),
	(9, 44, 3, 40, 3),
	(9, 45, 4, 40, 4),
	(9, 46, 5, 40, 5),
	(10, 41, 1, 39, 1),
	(10, 42, 1, 40, 1),
	(10, 43, 2, 40, 2),
	(10, 44, 3, 40, 3),
	(10, 45, 4, 40, 4),
	(10, 46, 5, 40, 5),
	(11, 41, 1, 39, 1),
	(11, 42, 1, 40, 1),
	(11, 43, 2, 40, 2),
	(11, 44, 3, 40, 3),
	(11, 45, 4, 40, 4),
	(11, 46, 5, 40, 5),
	(12, 41, 1, 39, 1),
	(12, 42, 1, 40, 1),
	(12, 43, 2, 40, 2),
	(12, 44, 3, 40, 3),
	(12, 45, 4, 40, 4),
	(12, 46, 5, 40, 5);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES 	(13, 41, 1, 39, 1),
	(13, 48, 2, 39, 2),
	(13, 44, 1, 40, 1),
	(13, 45, 2, 40, 2),
	(13, 46, 3, 40, 3);
