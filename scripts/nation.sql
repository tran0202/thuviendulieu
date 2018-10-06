CREATE TABLE IF NOT EXISTS nation (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL UNIQUE,
	alternative_name VARCHAR(255),
	code VARCHAR(255),
	flag_filename VARCHAR(255),
	alternative_flag_filename VARCHAR(255),
	parent_nation_id INT,
	nation_type_id INT,
	FOREIGN KEY (parent_nation_id) REFERENCES nation(id),
	FOREIGN KEY (nation_type_id) REFERENCES group_type(id)
);

ALTER TABLE nation
	ADD COLUMN code VARCHAR(255);

INSERT INTO nation (name, flag_filename, nation_type_id, code)
VALUES ('Afghanistan', 'Afghanistan.png', 6, 'AFG'), ('Albania', 'Albania.png', 6, 'ALB'),
	('Algeria', 'Algeria.png', 6, 'ALG'), ('American Samoa', 'American_Samoa.png', 7, 'ASA'),
	('Andorra', 'Andorra.png', 6, 'AND'), ('Angola', 'Angola.png', 6, 'ANG'),
	('Anguilla', 'Anguilla.png', 7, 'AIA'), ('Antigua and Barbuda', 'Antigua_and_Barbuda.png', 6, 'ATG'),
	('Argentina', 'Argentina.png', 6, 'ARG'), ('Armenia', 'Armenia.png', 6, 'ARM'),
	('Aruba', 'Aruba.png', 6, 'ARU'), ('Australia', 'Australia.png', 6, 'AUS'),
	('Austria', 'Austria.png', 6, 'AUT'), ('Azerbaijan', 'Azerbaijan.png', 6, 'AZE'),
	('Bahamas', 'Bahamas.png', 6, 'BAH'), ('Bahrain', 'Bahrain.png', 6, 'BHR'),
	('Bangladesh', 'Bangladesh.png', 6, 'BAN'), ('Barbados', 'Barbados.png', 6, 'BRB'),
	('Belarus', 'Belarus.png', 6, 'BLR'), ('Belgium', 'Belgium.png', 6, 'BEL'),
	('Belize', 'Belize.png', 6, 'BLZ'), ('Benin', 'Benin.png', 6, 'BEN'),
	('Bermuda', 'Bermuda.png', 6, 'BER'), ('Bhutan', 'Bhutan.png', 6, 'BHU'),
	('Bolivia', 'Bolivia.png', 6, 'BOL'), ('Bosnia and Herzegovina', 'Bosnia_and_Herzegovina.png', 6, 'BIH'),
	('Botswana', 'Botswana.png', 6, 'BOT'), ('Brazil', 'Brazil.png', 6, 'BRA'),
	('British Virgin Islands', 'British_Virgin_Islands.png', 7, 'VGB'), ('Brunei Darussalam', 'Brunei_Darussalam.png', 6, 'BRU'),
	('Bulgaria', 'Bulgaria.png', 6, 'BUL'), ('Burkina Faso', 'Burkina_Faso.png', 6, 'BFA'),
	('Burundi', 'Burundi.png', 6, 'BDI'), ('Cambodia', 'Cambodia.png', 6, 'CAM'),
	('Cameroon', 'Cameroon.png', 6, 'CMR'), ('Canada', 'Canada.png', 6, 'CAN'),
	('Cape Verde Islands', 'Cape_Verde_Islands.png', 6, 'CPV'), ('Cayman Islands', 'Cayman_Islands.png', 7, 'CAY'),
	('Central African Republic', 'Central_African_Republic.png', 6, 'CTA'), ('Chad', 'Chad.png', 6, 'CHA'),
	('Chile', 'Chile.png', 6, 'CHI'), ('China PR', 'China_PR.png', 6, 'CHN'),
	('Chinese Taipei', 'Chinese_Taipei.png', 6, 'TPE'), ('Colombia', 'Colombia.png', 6, 'COL'),
	('Comoros', 'Comoros.png', 6, 'COM'), ('Congo', 'Congo.png', 6, 'CGO'),
	('Congo DR', 'Congo_DR.png', 6, 'COD'), ('Cook Islands', 'Cook_Islands.png', 6, 'COK'),
	('Costa Rica', 'Costa_Rica.png', 6, 'CRC'), ('Côte d''Ivoire', 'Côte d''Ivoire.png', 6, 'CIV'),
	('Croatia', 'Croatia.png', 6, 'CRO'), ('Cuba', 'Cuba.png', 6, 'CUB'),
	('Curaçao', 'Curaçao.png', 6, 'CUW'), ('Cyprus', 'Cyprus.png', 6, 'CYP'),
	('Czech Republic', 'Czech_Republic.png', 6, 'CZE'), ('Denmark', 'Denmark.png', 6, 'DEN'),
	('Djibouti', 'Djibouti.png', 6, 'DJI'), ('Dominica', 'Dominica.png', 6, 'DMA'),
	('Dominican Republic', 'Dominican_Republic.png', 6, 'DOM'), ('Ecuador', 'Ecuador.png', 6, 'ECU'),
	('Egypt', 'Egypt.png', 6, 'EGY'), ('El Salvador', 'El_Salvador.png', 6, 'SLV'),
	('England', 'England.png', 6, 'ENG'), ('Equatorial Guinea', 'Equatorial_Guinea.png', 6, 'EQG'),
	('Eritrea', 'Eritrea.png', 6, 'ERI'), ('Estonia', 'Estonia.png', 6, 'EST'),
	('Ethiopia', 'Ethiopia.png', 6, 'ETH'), ('Faroe Islands', 'Faroe Islands.png', 6, 'FRO'),
	('Fiji', 'Fiji.png', 6, 'FIJ'), ('Finland', 'Finland.png', 6, 'FIN'),
	('France', 'France.png', 6, 'FRA'), ('FYR Macedonia', 'FYR_Macedonia.png', 6, 'MKD'),
	('Gabon', 'Gabon.png', 6, 'GAB'), ('Gambia', 'Gambia.png', 6, 'GAM'),
	('Georgia', 'Georgia.png', 6, 'GEO'), ('Germany', 'Germany.png', 6, 'GER'),
	('Ghana', 'Ghana.png', 6, 'GHA'), ('Gibraltar', 'Gibraltar.png', 7, 'GIB'),
	('Greece', 'Greece.png', 6, 'GRE'), ('Grenada', 'Grenada.png', 6, 'GRN'),
	('Guam', 'Guam.png', 6, 'GUM'), ('Guatemala', 'Guatemala.png', 6, 'GUA'),
	('Guinea', 'Guinea.png', 6, 'GUI'), ('Guinea-Bissau', 'Guinea-Bissau.png', 6, 'GNB'),
	('Guyana', 'Guyana.png', 6, 'GUY'), ('Haiti', 'Haiti.png', 6, 'HAI'),
	('Honduras', 'Honduras.png', 6, 'HON'), ('Hong Kong', 'Hong_Kong.png', 7, 'HKG'),
	('Hungary', 'Hungary.png', 6, 'HUN'), ('Iceland', 'Iceland.png', 6, 'ISL'),
	('India', 'India.png', 6, 'IND'), ('Indonesia', 'Indonesia.png', 6, 'IDN'),
	('Iran', 'Iran.png', 6, 'IRN'), ('Iraq', 'Iraq.png', 6, 'IRQ'),
	('Israel', 'Israel.png', 6, 'ISR'), ('Italy', 'Italy.png', 6, 'ITA'),
	('Jamaica', 'Jamaica.png', 6, 'JAM'), ('Japan', 'Japan.png', 6, 'JPN'),
	('Jordan', 'Jordan.png', 6, 'JOR'), ('Kazakhstan', 'Kazakhstan.png', 6, 'KAZ'),
	('Kenya', 'Kenya.png', 6, 'KEN'), ('Korea DPR', 'Korea_DPR.png', 6, 'PRK'),
	('Korea Republic', 'Korea_Republic.png', 6, 'KOR'), ('Kosovo', 'Kosovo.png', 7, 'KVX'),
	('Kuwait', 'Kuwait.png', 6, 'KUW'), ('Kyrgyz Republic', 'Kyrgyz_Republic.png', 6, 'KGZ'),
	('Laos', 'Laos.png', 6, 'LAO'), ('Latvia', 'Latvia.png', 6, 'LVA'),
	('Lebanon', 'Lebanon.png', 6, 'LIB'), ('Lesotho', 'Lesotho.png', 6, 'LES'),
	('Liberia', 'Liberia.png', 6, 'LBR'), ('Libya', 'Libya.png', 6, 'LBY'),
	('Liechtenstein', 'Liechtenstein.png', 6, 'LIE'), ('Lithuania', 'Lithuania.png', 6, 'LTU'),
	('Luxembourg', 'Luxembourg.png', 6, 'LUX'), ('Macau', 'Macau.png', 7, 'MAC'),
	('Madagascar', 'Madagascar.png', 6, 'MAD'), ('Malawi', 'Malawi.png', 6, 'MWI'),
	('Malaysia', 'Malaysia.png', 6, 'MAS'), ('Maldives', 'Maldives.png', 6, 'MDV'),
	('Mali', 'Mali.png', 6, 'MLI'), ('Malta', 'Malta.png', 6, 'MLT'),
	('Mauritania', 'Mauritania.png', 6, 'MTN'), ('Mauritius', 'Mauritius.png', 6, 'MRI'),
	('Mexico', 'Mexico.png', 6, 'MEX'), ('Moldova', 'Moldova.png', 6, 'MDA'),
	('Mongolia', 'Mongolia.png', 6, 'MNG'), ('Montenegro', 'Montenegro.png', 6, 'MNE'),
	('Montserrat', 'Montserrat.png', 7, 'MSR'), ('Morocco', 'Morocco.png', 6, 'MAR'),
	('Mozambique', 'Mozambique.png', 6, 'MOZ'), ('Myanmar', 'Myanmar.png', 6, 'MYA'),
	('Namibia', 'Namibia.png', 6, 'NAM'), ('Nepal', 'Nepal.png', 6, 'NEP'),
	('Netherlands', 'Netherlands.png', 6, 'NED'), ('New Caledonia', 'New_Caledonia.png', 7, 'NCL'),
	('New Zealand', 'New_Zealand.png', 6, 'NZL'), ('Nicaragua', 'Nicaragua.png', 6, 'NCA'),
	('Niger', 'Niger.png', 6, 'NIG'), ('Nigeria', 'Nigeria.png', 6, 'NGA'),
	('Northern Ireland', 'Northern_Ireland.png', 6, 'NIR'), ('Norway', 'Norway.png', 6, 'NOR'),
	('Oman', 'Oman.png', 6, 'OMA'), ('Pakistan', 'Pakistan.png', 6, 'PAK'),
	('Palestine', 'Palestine.png', 6, 'PLE'), ('Panama', 'Panama.png', 6, 'PAN'),
	('Papua New Guinea', 'Papua_New_Guinea.png', 6, 'PNG'), ('Paraguay', 'Paraguay.png', 6, 'PAR'),
	('Peru', 'Peru.png', 6, 'PER'), ('Philippines', 'Philippines.png', 6, 'PHI'),
	('Poland', 'Poland.png', 6, 'POL'), ('Portugal', 'Portugal.png', 6, 'POR'),
	('Puerto Rico', 'Puerto_Rico.png', 7, 'PUR'), ('Qatar', 'Qatar.png', 6, 'QAT'),
	('Republic of Ireland', 'Republic_of_Ireland.png', 6, 'IRL'), ('Romania', 'Romania.png', 6, 'ROU'),
	('Russia', 'Russia.png', 6, 'RUS'), ('Rwanda', 'Rwanda.png', 6, 'RWA'),
	('Samoa', 'Samoa.png', 6, 'SAM'), ('San Marino', 'San_Marino.png', 6, 'SMR'),
	('São Tomé e Príncipe', 'São_Tomé_e_Príncipe.png', 6, 'STP'), ('Saudi Arabia', 'Saudi_Arabia.png', 6, 'KSA'),
	('Scotland', 'Scotland.png', 6, 'SCO'), ('Senegal', 'Senegal.png', 6, 'SEN'),
	('Serbia', 'Serbia.png', 6, 'SRB'), ('Seychelles', 'Seychelles.png', 6, 'SEY'),
	('Sierra Leone', 'Sierra_Leone.png', 6, 'SLE'), ('Singapore', 'Singapore.png', 6, 'SIN'),
	('Slovakia', 'Slovakia.png', 6, 'SVK'), ('Slovenia', 'Slovenia.png', 6, 'SVN'),
	('Solomon Islands', 'Solomon_Islands.png', 6, 'SOL'), ('Somalia', 'Somalia.png', 6, 'SOM'), ('South Africa', 'South_Africa.png', 6, 'RSA'),
	('South Sudan', 'South_Sudan.png', 6, 'SSD'), ('Spain', 'Spain.png', 6, 'ESP'),
	('Sri Lanka', 'Sri_Lanka.png', 6, 'SRI'), ('St. Kitts and Nevis', 'St._Kitts_and_Nevis.png', 6, 'SKN'),
	('St. Lucia', 'St._Lucia.png', 6, 'LCA'), ('St. Vincent and the Grenadines', 'St._Vincent_and_the_Grenadines.png', 6, 'VIN'),
	('Sudan', 'Sudan.png', 6, 'SDN'), ('Suriname', 'Suriname.png', 6, 'SUR'),
	('Swaziland', 'Swaziland.png', 6, 'SWZ'), ('Sweden', 'Sweden.png', 6, 'SWE'),
	('Switzerland', 'Switzerland.png', 6, 'SUI'), ('Syria', 'Syria.png', 6, 'SYR'),
	('Tahiti', 'Tahiti.png', 6, 'TAH'), ('Tajikistan', 'Tajikistan.png', 6, 'TJK'),
	('Tanzania', 'Tanzania.png', 6, 'TAN'), ('Thailand', 'Thailand.png', 6, 'THA'),
	('Timor-Leste', 'Timor-Leste.png', 6, 'TLS'), ('Togo', 'Togo.png', 6, 'TOG'),
	('Tonga', 'Tonga.png', 6, 'TGA'), ('Trinidad and Tobago', 'Trinidad_and_Tobago.png', 6, 'TRI'), ('Tunisia', 'Tunisia.png', 6, 'TUN'),
	('Turkey', 'Turkey.png', 6, 'TUR'), ('Turkmenistan', 'Turkmenistan.png', 6, 'TKM'),
	('Turks and Caicos Islands', 'Turks_and_Caicos_Islands.png', 7, 'TCA'), ('Uganda', 'Uganda.png', 6, 'UGA'),
	('Ukraine', 'Ukraine.png', 6, 'UKR'), ('United Arab Emirates', 'United_Arab_Emirates.png', 6, 'UAE'),
	('Uruguay', 'Uruguay.png', 6, 'URU'), ('US Virgin Islands', 'US_Virgin_Islands.png', 7, 'VIR'),
	('USA', 'USA.png', 6, 'USA'), ('Uzbekistan', 'Uzbekistan.png', 6, 'UZB'),
	('Vanuatu', 'Vanuatu.png', 6, 'VAN'), ('Venezuela', 'Venezuela.png', 6, 'VEN'),
	('Vietnam', 'Vietnam.png', 6, 'VIE'), ('Wales', 'Wales.png', 6, 'WAL'),
	('Yemen', 'Yemen.png', 6, 'YEM'), ('Zambia', 'Zambia.png', 6, 'ZAM'), ('Zimbabwe', 'Zimbabwe.png', 6, 'ZIM'),
	('Great Britain', 'Great_Britain.png', 6, 'GBR'), ('Serbia and Montenegro', 'Serbia_and_Montenegro.svg', 6, 'SCG'), ('Yugoslavia', 'yug.png', 6, 'YUG'),
	('Germany FR', 'Germany.png', 6, 'GER'), ('Soviet Union', 'urs.png', 6, 'URS'), ('Czechoslovakia', 'tch.png', 6, 'TCH'),
	('Germany DR', 'gdr.png', 6, 'GDR'), ('Zaire', 'zai.png', 6, 'ZAI'), ('Dutch East Indies', 'inh.png', 6, 'INH'), ('Spain*', 'Olympic.png', 6, 'OLY'),
	   ('Burma', 'Burma.png', 6, 'BIR'), ('United Arab Republic', 'United_Arab_Republic.png', 6, 'UAR'), ('Republic of China', 'Republic_of_China.png', 6, 'ROC');

INSERT INTO nation (name, flag_filename, nation_type_id, code)
VALUES ('Netherlands Antilles', 'Netherlands_Antilles.png', 6, 'ANT');

INSERT INTO nation (name, flag_filename, parent_nation_id, nation_type_id, code)
VALUES ('FR Yugoslavia', 'Serbia_and_Montenegro.svg', 165, 6, 'YUG');
