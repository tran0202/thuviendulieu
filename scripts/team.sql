DROP TABLE IF EXISTS team;

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

ALTER TABLE team
	ADD COLUMN official_name VARCHAR(255);

ALTER TABLE team
	ADD CONSTRAINT team_ibfk_3
	FOREIGN KEY (parent_team_id) REFERENCES team(id);

ALTER TABLE team DROP INDEX `name`;

SELECT t.name AS name, tt.team_id,
	   group_id, g.name AS group_name, group_order,
	   parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order,
	   tl.logo_filename, tt.tournament_id
FROM team_tournament tt
		 LEFT JOIN team t ON t.id = tt.team_id
		 LEFT JOIN `group` g ON g.id = tt.group_id
		 LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
		 LEFT JOIN team_logo tl ON tl.team_id = t.id
WHERE tt.tournament_id = 2
ORDER BY parent_group_name, group_id, group_order;

DELETE FROM `team`
WHERE id = 1014 or id = 1015 or id = 1016 or id = 1017 or id = 1018 or id = 1019;

INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Yugoslavia', 1, 241, 24),
	   ('Italy', 1, 244, 203),
	   ('Germany', 1, 245, 2),
	   ('Spain', 1, 247, 6),
	   ('Spain', 1, 252, 6),
	   ('Spain', 1, 267, 6),
	   ('Hungary', 1, 248, 233),
	   ('Hungary', 1, 254, 233),
	   ('Egypt', 1, 249, 8),
	   ('Germany', 1, 246, 2),
	   ('Wales', 1, 256, 243),
	   ('Bulgaria', 1, 258, 223),
	   ('Bulgaria', 1, 259, 223),
	   ('Bulgaria', 1, 260, 223),
	   ('Romania', 1, 264, 226),
	   ('Haiti', 1, 265, 240),
	   ('Iran', 1, 266, 14),
	   ('Iraq', 1, 268, null);

INSERT INTO team (name, team_type_id, nation_id, parent_team_id)
VALUES ('Iraq', 1, 275, 1064);

INSERT INTO team (name, team_type_id)
VALUES ('Brazil', 1), ('Germany', 1), ('Argentina', 1),	('Portugal', 1),
		('Belgium', 1),	('Spain', 1), ('Poland', 1), ('Egypt', 1),
		('Morocco', 1),	('Nigeria', 1),	('Senegal', 1),	('Tunisia', 1),
		('Australia', 1), ('IR Iran', 1), ('Japan', 1),	('Korea Republic', 1),
		('Saudi Arabia', 1), ('Croatia', 1), ('Denmark', 1), ('England', 1),
		('France', 1), ('Iceland', 1), ('Russia', 1), ('Serbia', 1),
		('Sweden', 1), ('Switzerland', 1), ('Costa Rica', 1), ('Mexico', 1),
		('Panama', 1), ('Colombia', 1),	('Peru', 1), ('Uruguay', 1),
		('Arizona Cardinals', 6), ('Atlanta Falcons', 6), ('Baltimore Ravens', 6), ('Buffalo Bills', 6),
		('Carolina Panthers', 6), ('Chicago Bears', 6),	('Cincinnati Bengals', 6), ('Cleveland Browns', 6),
		('Dallas Cowboys', 6), ('Denver Broncos', 6), ('Detroit Lions', 6),	('Green Bay Packers', 6),
		('Houston Texans', 6), ('Indianapolis Colts', 6), ('Jacksonville Jaguars', 6), ('Kansas City Chiefs', 6),
		('Los Angeles Chargers', 6), ('Los Angeles Rams', 6), ('Miami Dolphins', 6), ('Minnesota Vikings', 6),
		('New England Patriots', 6), ('New Orleans Saints', 6),	('New York Giants', 6),	('New York Jets', 6),
		('Oakland Raiders', 6),	('Philadelphia Eagles', 6),	('Pittsburgh Steelers', 6),	('San Francisco 49ers', 6),
		('Seattle Seahawks', 6), ('Tampa Bay Buccaneers', 6), ('Tennessee Titans', 6), ('Washington Redskins', 6);

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Algeria', 1, 3), ('Cameroon', 1, 35), ('Ghana', 1, 77), ('Côte d''Ivoire', 1, 50),
	   ('Honduras', 1, 87), ('United States', 1, 203), ('Chile', 1, 41), ('Ecuador', 1, 60),
	   ('Bosnia and Herzegovina', 1, 26), ('Greece', 1, 79), ('Italy', 1, 96), ('Netherlands', 1, 135),
	   ('South Africa', 1, 173), ('Slovenia', 1, 170), ('Paraguay', 1, 148), ('New Zealand', 1, 137),
	   ('Slovakia', 1, 169), ('Korea DPR', 1, 102),
	   ('Trinidad and Tobago', 1, 193), ('Angola', 1, 6), ('Czech Republic', 1, 55), ('Togo', 1, 191),
	   ('Ukraine', 1, 199), ('Serbia and Montenegro', 1, 213),
	   ('Republic of Ireland', 1, 155), ('Turkey', 1, 195), ('China PR', 1, 42),
	   ('Scotland', 1, 163), ('Norway', 1, 142), ('Austria', 1, 13), ('Bulgaria', 1, 31),
	   ('Yugoslavia', 1, 214), ('Jamaica', 1, 97), ('Romania', 1, 156), ('Bolivia', 1, 25),
	   ('Soviet Union', 1, 216), ('United Arab Emirates', 1, 200), ('Czechoslovakia', 1, 217), ('Germany FR', 1, 215),
	   ('Canada', 1, 36), ('Hungary', 1, 89), ('Northern Ireland', 1, 141), ('Iraq', 1, 94),
	   ('El Salvador', 1, 62), ('Kuwait', 1, 105),
	   ('Germany DR', 1, 218), ('Zaire', 1, 219), ('Haiti', 1, 86), ('Congo DR', 1, 47), ('Israel', 1, 95), ('Wales', 1, 208),
	   ('Dutch East Indies', 1, 220), ('Indonesia', 1, 92), ('Cuba', 1, 52),
	   ('Albania', 1, 2), ('Estonia', 1, 66), ('Finland', 1, 70), ('Cyprus', 1, 54),
	   ('Lithuania', 1, 114), ('Montenegro', 1, 128), ('Andorra', 1, 5), ('Georgia', 1, 75),
	   ('Kazakhstan', 1, 100), ('Latvia', 1, 108), ('Belarus', 1, 19), ('Luxembourg', 1, 115),
	   ('Moldova', 1, 126), ('San Marino', 1, 160), ('Azerbaijan', 1, 14), ('Faroe Islands', 1, 68),
	   ('Kosovo', 1, 104), ('Malta', 1, 122), ('Armenia', 1, 10), ('FYR Macedonia', 1, 72),
	   ('Gibraltar', 1, 78), ('Liechtenstein', 1, 113);

# Women's

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Canada', 3, 36), ('China PR', 3, 42), ('Netherlands', 3, 135), ('New Zealand', 3, 137),
	   ('Germany', 3, 76), ('Norway', 3, 142), ('Thailand', 3, 189), ('Côte d''Ivoire', 3, 50),
	   ('Japan', 3, 98), ('Cameroon', 3, 35), ('Switzerland', 3, 184), ('Ecuador', 3, 60),
	   ('USA', 3, 203), ('Australia', 3, 12), ('Sweden', 3, 183), ('Nigeria', 3, 140),
	   ('Brazil', 3, 28), ('Korea Republic', 3, 103), ('Costa Rica', 3, 49), ('Spain', 3, 175),
	   ('France', 3, 71), ('England', 3, 63), ('Colombia', 3, 44), ('Mexico', 3, 125);

# Olympic

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Brazil', 4, 28), ('Denmark', 4, 56), ('Iraq', 4, 94), ('South Africa', 4, 173),
	   ('Nigeria', 4, 140), ('Colombia', 4, 44), ('Japan', 4, 98), ('Sweden', 4, 183),
	   ('Korea Republic', 4, 103), ('Germany', 4, 76), ('Mexico', 4, 125), ('Fiji', 4, 69),
	   ('Portugal', 4, 152), ('Honduras', 4, 87), ('Argentina', 4, 9), ('Algeria', 4, 3),
	   ('Spain*', 4, 222), ('Burma', 4, 223), ('United Arab Republic', 4, 224), ('Republic of China', 4, 225);

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Netherlands Antilles', 4, 226);

# Women's Olympic

INSERT INTO team (name, team_type_id, nation_id)
VALUES ('Brazil', 5, 28), ('China PR', 5, 42), ('Sweden', 5, 183), ('South Africa', 5, 173),
	   ('Canada', 5, 36), ('Germany', 5, 76), ('Australia', 5, 12), ('Zimbabwe', 5, 211),
	   ('USA', 5, 203), ('France', 5, 71), ('New Zealand', 5, 137), ('Colombia', 5, 44);

INSERT INTO team (name, official_name, team_type_id, nation_id, code)
VALUES ('Atletico Madrid', 'Club Atlético de Madrid', 2, 175, 'ATM'),
	   ('Barcelona', 'FC Barcelona', 2, 175, 'FCB'),
	   ('Bayern Munich', 'FC Bayern München', 2, 76, 'BAY'),
	   ('Club Brugge', 'Club Brugge', 2, 20, 'BRU'),
	   ('CSKA Moscow', 'PFC CSKA Moskva', 2, 157, 'CSK'),
	   ('Borussia Dortmund', 'Borussia Dortmund', 2, 76, 'DOR'),
	   ('Galatasaray', 'Galatasaray AŞ', 2, 195, 'GAL'),
	   ('Hoffenheim', 'TSG 1899 Hoffenheim', 2, 76, 'TSG'),
	   ('Inter Milan', 'FC Internazionale Milano', 2, 96, 'INT'),
	   ('Juventus', 'Juventus', 2, 96, 'JUV'),
	   ('Liverpool', 'Liverpool FC', 2, 63, 'LIV'),
	   ('Lokomotiv Moscow', 'FC Lokomotiv Moskva', 2, 157, 'LMO'),
	   ('Olympique Lyon', 'Olympique Lyonnais', 2, 71, 'LYO'),
	   ('Manchester City', 'Manchester City FC', 2, 63, 'MCI'),
	   ('Manchester United', 'Manchester United FC', 2, 63, 'MUN'),
	   ('Monaco', 'AS Monaco FC', 2, 71, 'AMO'),
	   ('Napoli', 'SSC Napoli', 2, 96, 'NAP'),
	   ('Paris St Germain', 'Paris Saint-Germain', 2, 71, 'PSG'),
	   ('Viktoria Plzen', 'FC Viktoria Plzeň', 2, 55, 'VPL'),
	   ('Porto', 'FC Porto', 2, 152, 'POR'),
	   ('Real Madrid', 'Real Madrid CF', 2, 175, 'MAD'),
	   ('AS Roma', 'AS Roma', 2, 96, 'ROM'),
	   ('Schalke 04', 'FC Schalke 04', 2, 76, 'S04'),
	   ('Shakhtar Donetsk', 'FC Shakhtar Donetsk', 2, 199, 'SHK'),
	   ('Tottenham Hotspur', 'Tottenham Hotspur FC', 2, 63, 'TOT'),
	   ('Valencia', 'Valencia CF', 2, 175, 'VAL'),
	   ('AEK Athens', 'AEK Athens FC', 2, 79, 'AEK'),
	   ('Ajax Amsterdam', 'AFC Ajax', 2, 135, 'AJA'),
	   ('BATE', 'FC BATE Borisov', 2, 19, 'BAT'),
	   ('Benfica', 'SL Benfica', 2, 152, 'SLB'),
	   ('Crvena zvezda', 'FK Crvena zvezda', 2, 165, 'CRV'),
	   ('Dinamo Zagreb', 'GNK Dinamo Zagreb', 2, 51, 'DZA'),
	   ('Dynamo Kiev', 'FC Dynamo Kyiv', 2, 199, 'DYK'),
	   ('PAOK', 'PAOK FC', 2, 79, 'PAO'),
	   ('PSV Eindhoven', 'PSV Eindhoven', 2, 135, 'PSV'),
	   ('Salzburg', 'FC Salzburg', 2, 13, 'RBS'),
	   ('Vidi', 'Vidi FC', 2, 89, 'VID'),
	   ('Young Boys', 'BSC Young Boys', 2, 184, 'YBO'),
	   ('Alashkert', 'Alashkert FC', 2, 10, 'ASH'),
	   ('APOEL', 'APOEL FC', 2, 54, 'APO'),
	   ('Astana', 'FC Astana', 2, 100, 'AST'),
	   ('Basel', 'FC Basel 1893', 2, 184, 'BAS'),
	   ('Celtic', 'Celtic FC', 2, 163, 'CEL'),
	   ('CFR Cluj', 'CFR 1907 Cluj', 2, 156, 'CFR'),
	   ('Cork', 'Cork City FC', 2, 155, 'COR'),
	   ('Crusaders', 'Crusaders FC', 2, 141, 'CRS'),
	   ('Drita', 'KF Drita', 2, 104, 'DRI'),
	   ('Dudelange', 'F91 Dudelange', 2, 115, 'F91'),
	   ('Santa Coloma', 'FC Santa Coloma', 2, 5, 'SAC'),
	   ('Fenerbahce', 'Fenerbahçe SK', 2, 195, 'FEN'),
	   ('Flora Tallinn', 'FC Flora Tallinn', 2, 66, 'FTA'),
	   ('Hapoel Beer-Sheva', 'Hapoel Beer-Sheva FC', 2, 95, 'HBS'),
	   ('HJK', 'HJK Helsinki', 2, 70, 'HJK'),
	   ('Kukesi', 'FK Kukësi', 2, 2, 'KUK'),
	   ('La Fiorita', 'SP La Fiorita', 2, 160, 'SPL'),
	   ('Legia Warszawa', 'Legia Warszawa', 2, 151, 'LEG'),
	   ('Lincoln Red Imps', 'Lincoln Red Imps FC', 2, 78, 'LRI'),
	   ('Ludogorets', 'PFC Ludogorets 1945', 2, 31, 'LUD'),
	   ('Malmo FF', 'Malmö FF', 2, 183, 'MAL'),
	   ('Midtjylland', 'FC Midtjylland', 2, 56, 'FCM'),
	   ('Olimpija Ljubljana', 'NK Olimpija Ljubljana', 2, 170, 'OLJ'),
	   ('Qarabag', 'Qarabağ FK', 2, 14, 'QAR'),
	   ('Rosenborg', 'Rosenborg BK', 2, 142, 'ROS'),
	   ('Sheriff Tiraspol', 'FC Sheriff Tiraspol', 2, 126, 'STI'),
	   ('Shkendija', 'KF Shkëndija', 2, 72, 'SKE'),
	   ('Slavia Prague', 'SK Slavia Praha', 2, 55, 'SLP'),
	   ('Spartak Moscow', 'FC Spartak Moskva', 2, 157, 'SPM'),
	   ('Spartak Trnava', 'FC Spartak Trnava', 2, 169, 'SPT'),
	   ('Spartaks Jurmala', 'FK Spartaks Jūrmala', 2, 108, 'JUR'),
	   ('Standard Liege', 'R. Standard de Liège', 2, 20, 'STL'),
	   ('Sturm Graz', 'SK Sturm Graz', 2, 13, 'SGR'),
	   ('Suduva', 'FK Sūduva', 2, 114, 'SUD'),
	   ('Sutjeska Niksic', 'FK Sutjeska', 2, 128, 'SUJ'),
	   ('The New Saints', 'The New Saints FC', 2, 208, 'TNS'),
	   ('Torpedo Kutaisi', 'FC Torpedo Kutaisi', 2, 75, 'KUT'),
	   ('Valletta', 'Valletta FC', 2, 122, 'VFC'),
	   ('Valur Reykjavik', 'Valur Reykjavík', 2, 90, 'VRE'),
	   ('Vikingur Gota', 'Víkingur', 2, 68, 'VIK'),
	   ('Zrinjski', 'HŠK Zrinjski', 2, 26, 'ZRI');

INSERT INTO team (name, official_name, team_type_id, nation_id, code)
VALUES ('Akhisar', 'Akhisar Belediyespor', 2, 195, 'AKB'),
	   ('Anderlecht', 'RSC Anderlecht', 2, 20, 'ADL'),
	   ('Arsenal', 'Arsenal FC', 2, 63, 'ARS'),
	   ('Real Betis', 'Real Betis Balompié', 2, 175, 'BET'),
	   ('Chelsea', 'Chelsea FC', 2, 63, 'CHE'),
	   ('Eintracht Frankfurt', 'Eintracht Frankfurt', 2, 76, 'SGE'),
	   ('Jablonec', 'FK Jablonec', 2, 55, 'JAB'),
	   ('Krasnodar', 'FC Krasnodar', 2, 157, 'KRA'),
	   ('Lazio', 'SS Lazio', 2, 96, 'LAZ'),
	   ('Bayer Leverkusen', 'Bayer 04 Leverkusen', 2, 76, 'B04'),
	   ('Olympique Marseille', 'Olympique de Marseille', 2, 71, 'OLM'),
	   ('AC Milan', 'AC Milan', 2, 96, 'MIL'),
	   ('Rennes', 'Stade Rennais FC', 2, 71, 'REN'),
	   ('Sporting CP', 'Sporting Clube de Portugal', 2, 152, 'SLI'),
	   ('Villarreal', 'Villarreal CF', 2, 175, 'VIL'),
	   ('Vorskla Poltava', 'FC Vorskla Poltava', 2, 199, 'VPO'),
	   ('Zurich', 'FC Zürich', 2, 184, 'ZUR'),
	   ('AEK Larnaca', 'AEK Larnaca FC', 2, 54, 'LAR'),
	   ('Apollon Limassol', 'Apollon Limassol FC', 2, 54, 'APL'),
	   ('Atalanta', 'Atalanta BC', 2, 96, 'ATT'),
	   ('Besiktas', 'Beşiktaş JK', 2, 195, 'BES'),
	   ('Bordeaux', 'FC Girondins de Bordeaux', 2, 71, 'BOR'),
	   ('Brondby', 'Brøndby IF', 2, 56, 'BIF'),
	   ('Burnley', 'Burnley FC', 2, 63, 'BUR'),
	   ('Steaua Bucharest', 'FC Steaua București', 2, 156, 'SBU'),
	   ('Genk', 'KRC Genk', 2, 20, 'GNK'),
	   ('Gent', 'KAA Gent', 2, 20, 'GNT'),
	   ('Kobenhavn', 'FC København', 2, 56, 'KOB'),
	   ('Leipzig', 'RB Leipzig', 2, 76, 'RBL'),
	   ('Maccabi Tel Aviv', 'Maccabi Tel-Aviv FC', 2, 195, 'MTA'),
	   ('Molde', 'Molde FK', 2, 142, 'MOL'),
	   ('Olympiacos', 'Olympiacos FC', 2, 79, 'OLY'),
	   ('Partizan Belgrade', 'FK Partizan', 2, 165, 'PBE'),
	   ('Rangers', 'Rangers FC', 2, 163, 'RFC'),
	   ('Rapid Vienna', 'SK Rapid Wien', 2, 13, 'RAV'),
	   ('Sarpsborg', 'Sarpsborg 08 FF', 2, 142, 'S08'),
	   ('Sevilla', 'Sevilla FC', 2, 175, 'SEV'),
	   ('Sigma Olomouc', 'SK Sigma Olomouc', 2, 55, 'SIG'),
	   ('Trencin', 'AS Trenčín', 2, 169, 'TRN'),
	   ('Ufa', 'FC Ufa', 2, 157, 'UFA'),
	   ('Zenit St Petersburg', 'FC Zenit', 2, 157, 'ZSP'),
	   ('Zorya Luhansk', 'FC Zorya Luhansk', 2, 199, 'ZOR'),
	   ('Aberdeen', 'Aberdeen FC', 2, 163, 'ABE'),
	   ('Admira', 'FC Admira Wacker Mödling', 2, 13, 'ADM'),
	   ('AIK', 'AIK', 2, 183, 'AIK'),
	   ('Anorthosis', 'Anorthosis Famagusta FC', 2, 54, 'ANO'),
	   ('Asteras Tripolis', 'Asteras Tripolis FC', 2, 79, 'ATR'),
	   ('Atromitos', 'Atromitos FC', 2, 79, 'ATS'),
	   ('AZ Alkmaar', 'AZ Alkmaar', 2, 135, 'AZA'),
	   ('B36 Torshavn', 'B36 Tórshavn', 2, 68, 'B36'),
	   ('Bala Town', 'Bala Town FC', 2, 208, 'BTO'),
	   ('Balzan', 'Balzan FC', 2, 122, 'BAL'),
	   ('Banants', 'FC Banants', 2, 10, 'BNA'),
	   ('Beitar Jerusalem', 'Beitar Jerusalem FC', 2, 95, 'BEJ'),
	   ('Birkirkara', 'Birkirkara FC', 2, 122, 'BIR'),
	   ('Braga', 'SC Braga', 2, 152, 'SBR'),
	   ('Buducnost Podgorica', 'FK Budućnost Podgorica', 2, 128, 'BUP'),
	   ('Cefn Druids', 'Cefn Druids AFC', 2, 208, 'CED'),
	   ('Chikhura', 'FC Chikhura Sachkhere', 2, 75, 'CHS'),
	   ('Cliftonville', 'Cliftonville FC', 2, 141, 'CLI'),
	   ('Coleraine', 'Coleraine FC', 2, 141, 'CFC'),
	   ('Connah''s Quay Nomads', 'Connah''s Quay Nomads FC', 2, 208, 'CQN'),
	   ('CSKA Sofia', 'PFC CSKA-Sofia', 2, 31, 'CSO'),
	   ('Derry City', 'Derry City FC', 2, 155, 'DER'),
	   ('Dinamo Brest', 'FC Dinamo Brest', 2, 19, 'DRB'),
	   ('Dinamo Minsk', 'FC Dinamo Minsk', 2, 19, 'DMI'),
	   ('Dinamo Tbilisi', 'FC Dinamo Tbilisi', 2, 75, 'TBI'),
	   ('Djurgardens', 'Djurgårdens IF', 2, 183, 'DJU'),
	   ('Domzale', 'NK Domžale', 2, 170, 'DOM'),
	   ('Dunajska Streda', 'FC DAC 1904 Dunajská Streda', 2, 169, 'DAC'),
	   ('Dundalk', 'Dundalk FC', 2, 155, 'DUN'),
	   ('Engordany', 'UE Engordany', 2, 5, 'UEE'),
	   ('Europa', 'Europa FC', 2, 78, 'EUR'),
	   ('Ferencvaros', 'Ferencvárosi TC', 2, 89, 'FER'),
	   ('Feyenoord', 'Feyenoord', 2, 135, 'FEY'),
	   ('FH', 'FH Hafnarfjördur', 2, 90, 'FHA'),
	   ('Fola', 'CS Fola Esch', 2, 115, 'FOL'),
	   ('Folgore', 'SS Folgore', 2, 160, 'FOG'),
	   ('Gabala', 'Gabala SC', 2, 14, 'GAB'),
	   ('Gandzasar', 'FC Gandzasar', 2, 10, 'GAN'),
	   ('Glenavon', 'Glenavon FC', 2, 141, 'GLE'),
	   ('Gornik Zabrze', 'Górnik Zabrze', 2, 151, 'ZAB'),
	   ('Gzira United', 'Gżira United FC', 2, 122, 'GZU'),
	   ('Hapoel Haifa', 'Hapoel Haifa FC', 2, 95, 'HHA'),
	   ('Hacken', 'BK Häcken', 2, 183, 'HAC'),
	   ('Hajduk Split', 'HNK Hajduk Split', 2, 51, 'HAJ'),
	   ('Hibernian', 'Hibernian FC', 2, 163, 'HIB'),
	   ('Budapest Honved', 'Budapest Honvéd FC', 2, 89, 'BUH'),
	   ('IBV', 'ÍBV Vestmannaeyjar', 2, 90, 'IBV'),
	   ('Ilves', 'Ilves Tampere', 2, 70, 'ILV'),
	   ('Irtysh Pavlodar', 'FC Irtysh Pavlodar', 2, 100, 'IPA'),
	   ('Istanbul Basaksehir', 'İstanbul Başakşehir', 2, 195, 'IBA'),
	   ('Jagiellonia Bialystok', 'Jagiellonia Białystok', 2, 151, 'JAG'),
	   ('Kairat', 'FC Kairat Almaty', 2, 100, 'KAI'),
	   ('Nomme Kalju', 'Nõmme Kalju FC', 2, 66, 'NOM'),
	   ('Kesla', 'Keşla FK', 2, 14, 'KES'),
	   ('KI Klaksvik', 'KÍ Klaksvík', 2, 68, 'KIK'),
	   ('KuPS', 'KuPS Kuopio', 2, 70, 'KUP'),
	   ('Laci', 'KF Laçi', 2, 2, 'LAC'),
	   ('Lahti', 'FC Lahti', 2, 70, 'LAH'),
	   ('LASK Linz', 'LASK Linz', 2, 13, 'LIN'),
	   ('Lech Poznan', 'KKS Lech Poznań', 2, 151, 'POZ'),
	   ('Levadia Tallinn', 'FC Levadia Tallinn', 2, 66, 'LET'),
	   ('Levski Sofia', 'PFC Levski Sofia', 2, 31, 'LSO'),
	   ('Liepaja', 'FK Liepāja', 2, 108, 'LIE'),
	   ('Lillestrom', 'Lillestrøm SK', 2, 142, 'LSK'),
	   ('Luftetari', 'KS Luftëtari', 2, 2, 'LUF'),
	   ('Luzern', 'FC Luzern', 2, 184, 'LUZ'),
	   ('Maribor', 'NK Maribor', 2, 170, 'MAR'),
	   ('Mariupol', 'FC Mariupol', 2, 199, 'MRP'),
	   ('Milsami Orhei', 'FC Milsami Orhei', 2, 126, 'ORH'),
	   ('Neftci Baku', 'Neftçi PFK', 2, 14, 'BAK'),
	   ('Nordsjaelland', 'FC Nordsjælland', 2, 56, 'FCN'),
	   ('Runavik', 'NSÍ Runavík', 2, 68, 'RUN'),
	   ('Osijek', 'NK Osijek', 2, 51, 'OSI'),
	   ('Partizani Tirana', 'FK Partizani', 2, 2, 'TIR'),
	   ('Petrocub Hincesti', 'CS Petrocub', 2, 126, 'HIN'),
	   ('Prishtina', 'FC Prishtina', 2, 104, 'PRI'),
	   ('Progres Niederkorn', 'FC Progrès Niederkorn', 2, 115, 'PRO'),
	   ('Pyunik', 'FC Pyunik', 2, 10, 'PYU'),
	   ('Rabotnicki', 'FK Rabotnicki', 2, 72, 'RAB'),
	   ('Racing Union', 'Racing FC Union Lëtzebuerg', 2, 115, 'RUL'),
	   ('Radnicki', 'FK Radnicki Niš', 2, 165, 'RAD'),
	   ('Riga', 'Riga FC', 2, 108, 'RIG'),
	   ('Rijeka', 'HNK Rijeka', 2, 51, 'RIJ'),
	   ('Rio Ave', 'Rio Ave FC', 2, 152, 'RIO'),
	   ('Rudar Pljevlja', 'FK Rudar Pljevlja', 2, 128, 'PLJ'),
	   ('Rudar Velenje', 'NK Rudar Velenje', 2, 128, 'RUV'),
	   ('Samtredia', 'FC Samtredia', 2, 75, 'FCS'),
	   ('Sant Julia', 'UE Sant Julià', 2, 5, 'SJU'),
	   ('Sarajevo', 'FK Sarajevo', 2, 26, 'SAR'),
	   ('Shakhtyor Soligorsk', 'FC Shakhtyor Soligorsk', 2, 19, 'SSO'),
	   ('Shamrock Rovers', 'Shamrock Rovers FC', 2, 155, 'SHR'),
	   ('Shkupi', 'FK Shkupi', 2, 72, 'FKS'),
	   ('Siroki Brijeg', 'NK Široki Brijeg', 2, 26, 'SIB'),
	   ('Slavia Sofia', 'PFC Slavia Sofia', 2, 31, 'SOF'),
	   ('Slovan Bratislava', 'ŠK Slovan Bratislava', 2, 169, 'SKS'),
	   ('Sparta Prague', 'AC Sparta Praha', 2, 55, 'SPP'),
	   ('Spartak Subotica', 'FK Spartak Subotica', 2, 165, 'SUB'),
	   ('St Gallen', 'FC St Gallen', 2, 184, 'STG'),
	   ('St Joseph''s', 'St Joseph''s FC', 2, 78, 'SJO'),
	   ('UMF Stjarnan', 'UMF Stjarnan', 2, 90, 'UMF'),
	   ('Stumbras Kaunas', 'FC Stumbras', 2, 114, 'KAU'),
	   ('Titograd Podgorica', 'OFK Titograd', 2, 128, 'POD'),
	   ('Tobol', 'FC Tobol Kostanay', 2, 100, 'TOB'),
	   ('Trakai', 'FK Trakai', 2, 114, 'FKT'),
	   ('Narva Trans', 'JK Narva Trans', 2, 66, 'NAR'),
	   ('Tre Fiori', 'SP Tre Fiori', 2, 160, 'TRF'),
	   ('Ujpest', 'Újpest FC', 2, 89, 'UJP'),
	   ('Universitatea Craiova', 'U Craiova 1948 Club Sportiv', 2, 156, 'UNC'),
	   ('Vaduz', 'FC Vaduz', 2, 113, 'VAD'),
	   ('Vardar', 'FK Vardar', 2, 72, 'VAR'),
	   ('Ventspils', 'FK Ventspils', 2, 108, 'VEN'),
	   ('Viitorul Constanta', 'Viitorul', 2, 108, '318VCO'),
	   ('Vitesse', 'Vitesse', 2, 135, 'VIT'),
	   ('Zalgiris', 'FK Žalgiris Vilnius', 2, 114, 'ZAL'),
	   ('Zaria Balti', 'FC Zaria Balti', 2, 126, 'ZAR'),
	   ('Zeljeznicar', 'FK Željezničar', 2, 26, 'ZEL');

INSERT INTO team (name, team_type_id)
VALUES ('Yuichi Sugita', 7), ('Geoffrey Blancaneaux', 7), ('Dominic Thiem', 7),	('Alex De Minaur', 7),
	   ('Bjorn Fratangelo', 7), ('Ivo Karlovic', 7), ('Richard Gasquet', 7), ('Leonardo Mayer', 7),
	   ('Adrian Menendez-Maceiras', 7), ('Patrick Kypson', 7),	('Donald Young', 7), ('Maximilian Marterer', 7),
	   ('Jeremy Chardy', 7), ('Gael Monfils',7), ('Taro Daniel', 7), ('Tommy Paul', 7),
	   ('Alexandr Dolgopolov', 7), ('Jan-Lennard Struff', 7), ('Tomas Berdych', 7), ('Ryan Harrison', 7),
	   ('Blaz Kavcic', 7), ('Mikhail Youzhny', 7), ('Ricardas Berankis', 7), ('Adrian Mannarino', 7),
	   ('Pablo Cuevas', 7), ('Damir Dzumhur', 7), ('Marcos Baghdatis', 7), ('Taylor Fritz', 7),
	   ('Norbert Gombos', 7), ('Viktor Troicki', 7), ('Henri Laaksonen', 7), ('Juan Martin Del Potro', 7),
	   ('Fabio Fognini', 7), ('Stefano Travaglia', 7), ('Cedrik-Marcel Stebe', 7), ('Nicolas Kicker', 7),
	   ('Julien Benneteau', 7), ('David Goffin', 7), ('Nick Kyrgios', 7), ('John Millman', 7),
	   ('Malek Jaziri', 7), ('Thiago Monteiro', 7), ('Steve Darcis', 7), ('Guido Pella', 7),
	   ('Aljaz Bedene', 7), ('Andrey Rublev', 7), ('Grigor Dimitrov', 7), ('Vaclav Safranek', 7),
	   ('Dusan Lajovic', 7), ('Rafael Nadal', 7), ('Andrey Kuznetsov', 7), ('Feliciano Lopez', 7),
	   ('Vasek Pospisil', 7), ('Fernando Verdasco', 7), ('Santiago Giraldo', 7), ('Vincent Millot', 7),
	   ('Philipp Kohlschreiber', 7), ('Tim Smyczek', 7), ('Thomaz Bellucci', 7), ('Dustin Brown', 7),
	   ('Roberto Bautista Agut', 7), ('Andreas Seppi', 7), ('Roger Federer', 7), ('Frances Tiafoe', 7),
	   ('Hyeon Chung', 7), ('Horacio Zeballos', 7), ('Kyle Edmund', 7), ('Robin Haase', 7),
	   ('Nicolas Almagro', 7), ('Steve Johnson', 7), ('Pablo Carreno Busta', 7), ('Evan King', 7),
	   ('Rogerio Dutra Silva', 7), ('Florian Mayer', 7), ('Dmitry Tursunov', 7), ('Cameron Norrie', 7),
	   ('Kevin Anderson', 7), ('JC Aragone',7), ('Carlos Berlocq', 7), ('Diego Schwartzman', 7),
	   ('Marius Copil', 7), ('Jo-Wilfried Tsonga', 7), ('Evgeny Donskoy', 7), ('Andreas Haider-Maurer', 7),
	   ('Radu Albot', 7), ('Ernesto Escobedo', 7), ('Alessandro Giannessi', 7), ('Ernests Gulbis', 7),
	   ('Pierre-Hugues Herbert', 7), ('John Isner', 7), ('David Ferrer', 7), ('Mikhail Kukushkin', 7),
	   ('Karen Khachanov', 7), ('Yen-Hsun Lu', 7), ('Lukas Lacko', 7), ('Benoit Paire', 7),
	   ('Marin Cilic', 7), ('Tennys Sandgren', 7), ('Denis Istomin', 7), ('Albert Ramos-Vinolas', 7),
	   ('Mischa Zverev', 7), ('Thai-Son Kwiatkowski', 7), ('Paolo Lorenzi', 7), ('Joao Sousa', 7),
	   ('Dudi Sela', 7), ('Christopher Eubanks', 7), ('Sam Querrey', 7), ('Gilles Simon', 7),
	   ('Marton Fucsovics', 7), ('Nicolas Mahut', 7), ('Daniil Medvedev', 7), ('Denis Shapovalov', 7),
	   ('Nikoloz Basilashvili', 7), ('Jared Donaldson', 7), ('Ruben Bemelmans', 7), ('Lucas Pouille', 7),
	   ('Thanasi Kokkinakis', 7), ('Janko Tipsarevic', 7), ('Gilles Muller', 7), ('Bernard Tomic', 7),
	   ('Jack Sock', 7), ('Jordan Thompson', 7), ('Alexander Zverev', 7), ('Darian King', 7),
	   ('Borna Coric', 7), ('Jiri Vesely', 7), ('Thomas Fabbiano', 7), ('John-Patrick Smith', 7),
	   ('Qualifier Player', null), ('Guido Andreozzi', 7), ('Mirza Basic', 7), ('Jason Kubler', 7),
	   ('Denis Kudla', 7), ('Matteo Berrettini', 7), ('Andy Murray', 7), ('James Duckworth', 7),
	   ('Roberto Carballes Baena', 7), ('Stefanos Tsitsipas', 7), ('Bradley Klahn', 7), ('Nicolas Jarry', 7),
	   ('Peter Gojowczyk', 7), ('Milos Raonic', 7), ('Stan Wawrinka', 7), ('Marco Cecchinato', 7),
	   ('Mackenzie McDonald', 7), ('Federico Delbonis', 7), ('Guillermo Garcia-Lopez', 7), ('Jaume Munar', 7),
	   ('Kei Nishikori', 7), ('Filip Krajinovic', 7), ('Matthew Ebden', 7), ('Yannick Hanfmann', 7),
	   ('Corentin Moutet', 7), ('Novak Djokovic', 7), ('Laslo Djere', 7), ('Michael Mmoh', 7),
	   ('Jenson Brooksby', 7), ('Noah Rubin', 7), ('Yuki Bhambri', 7), ('Yoshihito Nishioka', 7);

INSERT INTO team (name, team_type_id)
VALUES ('Lorenzo Sonego', 7), ('Casper Ruud', 7), ('Felix Auger-Aliassime', 7), ('Donald Young', 7),
	   ('Mitchell Krueger', 7), ('Tommy Robredo', 7), ('Lloyd Harris', 7), ('Collin Altamirano', 7),
	   ('Ugo Humbert', 7), ('Hubert Hurkacz', 7), ('Federico Gaio', 7), ('Facundo Bagnis', 7),
	   ('Peter Polansky', 7), ('Yannick Maden', 7), ('Marcel Granollers', 7), ('Dennis Novak', 7);

INSERT INTO team (name, team_type_id)
VALUES ('Simona Halep', 8), ('Kaia Kanepi', 8), ('Dalila Jakupovic', 8), ('Vania King', 8),
	   ('Natalia Vikhlyantseva', 8), ('Rebecca Peterson', 8), ('Anastasia Pavlyuchenkova', 8), ('Serena Williams', 8),
	   ('Magda Linette', 8), ('Caroline Dolehide', 8), ('Carina Witthoeft', 8), ('Camila Giorgi', 8),
	   ('Whitney Osuigwe', 8), ('Svetlana Kuznetsova', 8), ('Venus Williams', 8), ('Garbiñe Muguruza', 8),
	   ('Shuai Zhang', 8), ('Dayana Yastremska', 8), ('Petra Martic', 8), ('Lucie Safarova', 8),
	   ('Ashleigh Barty', 8), ('Maria Sakkari', 8), ('Asia Muhammad', 8), ('Luksika Kumkhum', 8),
	   ('Sofia Kenin', 8), ('Ana Bogdan', 8), ('Zarina Diyas', 8), ('Karolina Pliskova', 8),
	   ('Sloane Stephens', 8), ('Evgeniya Rodina', 8), ('Victoria Azarenka', 8), ('Viktoria Kuzmova', 8),
	   ('Sara Sorribes Tormo', 8), ('Daria Gavrilova', 8), ('Barbora Strycova', 8), ('Kateryna Kozlova', 8),
	   ('Lara Arruabarrena', 8), ('Verao Lapko', 8), ('Kateryna Bondarenko', 8), ('Kurumi Nara', 8),
	   ('Elise Mertens', 8), ('Julia Goerges', 8), ('Ekaterina Makarova', 8), ('Polona Hercog', 8),
	   ('Claire Liu', 8), ('Donna Vekic', 8), ('Anastasija Sevastova', 8), ('Magdalena Rybarikova', 8),
	   ('Qiang Wang', 8), ('Jennifer Brady', 8), ('Irina-Camelia Begu', 8), ('Agnieszka Radwanska', 8),
	   ('Tatjana Maria', 8), ('Sachia Vickery', 8), ('Elina Svitolina', 8), ('Caroline Garcia', 8),
	   ('Johanna Konta', 8), ('Monica Puig', 8), ('Stefanie Voegele', 8), ('Kristina Mladenovic', 8),
	   ('Tamara Zidansek', 8), ('Carla Suarez Navarro', 8), ('Maria Sharapova', 8), ('Sorana Cirstea', 8),
	   ('Alison Riske', 8), ('Taylor Townsend', 8), ('Amanda Anisimova', 8), ('Andrea Petkovic', 8),
	   ('Jelena Ostapenko', 8), ('Madison Keys', 8), ('Pauline Parmentier', 8), ('Yulia Putintseva', 8),
	   ('Bernarda Pera', 8), ('Timea Bacsinszky', 8), ('Aleksandra Krunic', 8), ('Kirsten Flipkens', 8),
	   ('Coco Vandeweghe', 8), ('Dominika Cibulkova', 8), ('Ekaterina Alexandrova', 8), ('Su-Wei Hsieh', 8),
	   ('Alize Cornet', 8), ('Johanna Larsson', 8), ('Margarita Gasparyan', 8), ('Angelique Kerber', 8),
	   ('Petra Kvitova', 8), ('Yanina Wickmayer', 8), ('Yafan Wang', 8), ('Anna Karolina Schmiedlova', 8),
	   ('Anna Blinkova', 8), ('Danielle Collins', 8), ('Aryna Sabalenka', 8), ('Naomi Osaka', 8),
	   ('Laura Siegemund', 8), ('Monica Niculescu', 8), ('Aliaksandra Sasnovich', 8), ('Belinda Bencic', 8),
	   ('Timea Babos', 8), ('Daria Kasatkina', 8), ('Kiki Bertens', 8), ('Kristyna Pliskova', 8),
	   ('Christina McHale', 8), ('Harmony Tan', 8), ('Marketa Vondrousova', 8), ('Mihaela Buzarnescu', 8),
	   ('Anett Kontaveit', 8), ('Katerina Siniakova', 8), ('Lizette Cabrera', 8), ('Ajla Tomljanovic', 8),
	   ('Alison Van Uytvanck', 8), ('Lesia Tsurenko', 8), ('Samantha Stosur', 8), ('Caroline Wozniacki', 8),
	   ('Jil Teichmann', 8), ('Karolina Muchova', 8), ('Ons Jabeur', 8), ('Marie Bouzkova', 8),
	   ('Kathinka Von Deichmann', 8), ('Anhelina Kalinina', 8), ('Danielle Lao', 8), ('Anna Kalinskaya', 8),
	   ('Heather Watson', 8), ('Nicole Gibbs', 8), ('Patty Schnyder', 8), ('Arantxa Rus', 8),
	   ('Vera Zvonareva', 8), ('Julia Glushko', 8), ('Francesca Di Lorenzo', 8), ('Eugenie Bouchard', 8),
	   ('Madison Brengle', 8);

INSERT INTO team (name, team_type_id)
VALUES ('Mona Barthel', 8);

DROP TRIGGER before_insert_team;
