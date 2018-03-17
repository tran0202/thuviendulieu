DROP TABLE IF EXISTS team_type;

CREATE TABLE IF NOT EXISTS team_type (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO team_type (name)
VALUES ('Men''s National'),
		('Club'),
		('Women''s National'),
		('U-23 Men''s National'),
		('U-23 Women''s National'),
		('Football'),
		('Tennis Men''s Single');

DROP TRIGGER before_insert_team_type;
