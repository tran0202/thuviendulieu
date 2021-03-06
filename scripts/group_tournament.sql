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
		(1, 42, 1, 40, 2),
		(1, 43, 2, 40, 2),
		(1, 44, 3, 40, 2),
		(1, 45, 4, 40, 2),
		(1, 46, 5, 40, 2),
	(5, 41, 1, 39, 1),
	(5, 42, 1, 40, 2),
	(5, 43, 2, 40, 2),
	(5, 44, 3, 40, 2),
	(5, 45, 4, 40, 2),
	(5, 46, 5, 40, 2),
	(6, 41, 1, 39, 1),
	(6, 42, 1, 40, 2),
	(6, 43, 2, 40, 2),
	(6, 44, 3, 40, 2),
	(6, 45, 4, 40, 2),
	(6, 46, 5, 40, 2),
	(7, 41, 1, 39, 1),
	(7, 42, 1, 40, 2),
	(7, 43, 2, 40, 2),
	(7, 44, 3, 40, 2),
	(7, 45, 4, 40, 2),
	(7, 46, 5, 40, 2),
	(8, 41, 1, 39, 1),
	(8, 42, 1, 40, 2),
	(8, 43, 2, 40, 2),
	(8, 44, 3, 40, 2),
	(8, 45, 4, 40, 2),
	(8, 46, 5, 40, 2),
	(9, 41, 1, 39, 1),
	(9, 42, 1, 40, 2),
	(9, 43, 2, 40, 2),
	(9, 44, 3, 40, 2),
	(9, 45, 4, 40, 2),
	(9, 46, 5, 40, 2),
	(10, 41, 1, 39, 1),
	(10, 42, 1, 40, 2),
	(10, 43, 2, 40, 2),
	(10, 44, 3, 40, 2),
	(10, 45, 4, 40, 2),
	(10, 46, 5, 40, 2),
	(11, 41, 1, 39, 1),
	(11, 42, 1, 40, 2),
	(11, 43, 2, 40, 2),
	(11, 44, 3, 40, 2),
	(11, 45, 4, 40, 2),
	(11, 46, 5, 40, 2),
	(12, 41, 1, 39, 1),
	(12, 42, 1, 40, 2),
	(12, 43, 2, 40, 2),
	(12, 44, 3, 40, 2),
	(12, 45, 4, 40, 2),
	(12, 46, 5, 40, 2),
	(13, 41, 1, 39, 1),
	(13, 48, 2, 39, 1),
	(13, 44, 1, 40, 2),
	(13, 45, 2, 40, 2),
	(13, 46, 3, 40, 2),
	(14, 41, 1, 39, 1),
	(14, 48, 2, 39, 1),
	(14, 45, 1, 40, 2),
	(14, 46, 2, 40, 2),
	(15, 41, 1, 39, 1),
	(15, 48, 2, 39, 1),
	(15, 45, 1, 40, 2),
	(15, 46, 2, 40, 2),
	(16, 41, 1, 39, 1),
	(16, 43, 1, 40, 2),
	(16, 44, 2, 40, 2),
	(16, 45, 3, 40, 2),
	(16, 46, 4, 40, 2),
	(17, 41, 1, 39, 1),
	(17, 43, 1, 40, 2),
	(17, 44, 2, 40, 2),
	(17, 45, 3, 40, 2),
	(17, 46, 4, 40, 2),
	(18, 41, 1, 39, 1),
	(18, 43, 1, 40, 2),
	(18, 44, 2, 40, 2),
	(18, 45, 3, 40, 2),
	(18, 46, 4, 40, 2),
	(19, 41, 1, 39, 1),
	(19, 57, 2, 39, 1),
	(19, 43, 1, 40, 2),
	(19, 44, 2, 40, 2),
	(19, 45, 3, 40, 2),
	(19, 46, 4, 40, 2),
	(20, 41, 1, 39, 1),
	(20, 57, 2, 39, 2),
	(20, 43, 1, 40, 1),
	(20, 44, 2, 40, 2),
	(20, 45, 3, 40, 3),
	(20, 46, 4, 40, 4),
	(21, 41, 1, 39, 1),
	(21, 58, 2, 39, 1),
	(22, 42, 1, 40, 1),
	(22, 43, 3, 40, 1),
	(22, 44, 5, 40, 1),
	(22, 45, 6, 40, 1),
	(22, 46, 7, 40, 1),
	(22, 156, 2, 40, 1),
		  (22, 62, 4, 40, 1),
	(23, 42, 1, 40, 1),
	(23, 43, 2, 40, 1),
		  (23, 62, 3, 40, 1),
	(23, 44, 4, 40, 1),
	(23, 45, 5, 40, 1),
	(23, 46, 6, 40, 1),
	(24, 41, 1, 39, 1),
	(24, 44, 1, 40, 2),
	(24, 46, 2, 40, 2),
	(25, 74, 1, 73, 1),
	(25, 75, 2, 73, 1),
	(25, 76, 3, 73, 1),
	(25, 77, 4, 73, 1),
	(25, 78, 5, 73, 1),
	(25, 79, 6, 73, 1),
		  (2, 83, 1, 80, 1),
		  (2, 84, 2, 80, 1),
		  (2, 85, 3, 80, 1),
		  (2, 86, 4, 80, 1),
		  (2, 87, 5, 80, 1),
		  (2, 84, 1, 81, 2),
		  (2, 85, 2, 81, 2),
		  (2, 86, 3, 81, 2),
		  (2, 87, 4, 81, 2),
		  (2, 88, 5, 81, 2),
		  (2, 89, 6, 81, 2),
		  (2, 90, 7, 81, 2),
		  (2, 91, 8, 81, 2),
		  (2, 92, 9, 81, 2),
		  (2, 93, 10, 81, 2),
		  (2, 94, 11, 81, 2),
		  (2, 95, 12, 81, 2),
		  (2, 96, 13, 81, 2),
		  (2, 97, 14, 81, 2),
		  (2, 98, 15, 81, 2),
		  (2, 99, 16, 81, 2),
		  (2, 100, 17, 81, 2),
		  (2, 101, 1, 82, 3),
		  (2, 102, 2, 82, 3),
		  (2, 103, 3, 82, 3),
		  (2, 104, 4, 82, 3),
		  (2, 105, 5, 82, 3),
		  (25, 44, 1, 40, 2),
		  (25, 45, 2, 40, 2),
		  (25, 46, 3, 40, 2),
		  (29, 107, 1, 106, 1),
		  (29, 108, 2, 106, 1),
		  (29, 111, 3, 106, 1),
		  (29, 112, 4, 106, 1),
		  (29, 113, 5, 106, 1),
		  (29, 114, 6, 106, 1),
		  (29, 115, 7, 106, 1),
		  (29, 116, 8, 106, 1),
		  (29, 117, 9, 106, 1),
		  (29, 118, 10, 106, 1),
		  (29, 74, 1, 73, 2),
		  (29, 75, 2, 73, 2),
		  (29, 76, 3, 73, 2),
		  (29, 77, 4, 73, 2),
		  (29, 78, 5, 73, 2),
		  (29, 79, 6, 73, 2),
		  (29, 121, 1, 127, 3),
		  (29, 122, 2, 127, 3),
		  (29, 123, 3, 127, 3),
		  (29, 124, 4, 127, 3),
		  (29, 125, 5, 127, 3),
		  (29, 126, 6, 127, 3),
		  (29, 46, 7, 127, 3),
		  (30, 109, 1, 106, 1),
		  (30, 110, 2, 106, 1),
		  (30, 111, 3, 106, 1),
		  (30, 112, 4, 106, 1),
		  (30, 113, 5, 106, 1),
		  (30, 114, 6, 106, 1),
		  (30, 115, 7, 106, 1),
		  (30, 116, 8, 106, 1),
		  (30, 117, 9, 106, 1),
		  (30, 118, 10, 106, 1),
		  (30, 74, 1, 73, 2),
		  (30, 75, 2, 73, 2),
		  (30, 76, 3, 73, 2),
		  (30, 77, 4, 73, 2),
		  (30, 78, 5, 73, 2),
		  (30, 79, 6, 73, 2),
		  (30, 119, 1, 127, 3),
		  (30, 120, 2, 127, 3),
		  (30, 121, 3, 127, 3),
		  (30, 122, 4, 127, 3),
		  (30, 123, 5, 127, 3),
		  (30, 124, 6, 127, 3),
		  (30, 125, 7, 127, 3),
		  (30, 126, 8, 127, 3),
		  (30, 46, 9, 127, 3),
		  (31, 41, 1, 39, 1),
		  (31, 42, 1, 40, 2),
		  (31, 43, 2, 40, 2),
		  (31, 44, 3, 40, 2),
		  (31, 45, 4, 40, 2),
		  (31, 46, 5, 40, 2);

INSERT INTO group_tournament (tournament_id, group_id, group_order, parent_group_id, parent_group_order)
VALUES (32, 41, 1, 39, 1),
	   (32, 43, 1, 40, 2),
	   (32, 44, 2, 40, 2),
	   (32, 132, 3, 40, 2),
	   (32, 133, 4, 40, 2),
	   (33, 41, 1, 39, 1),
	   (33, 43, 1, 40, 2),
	   (33, 44, 2, 40, 2),
	   (33, 132, 3, 40, 2),
	   (33, 133, 4, 40, 2);
