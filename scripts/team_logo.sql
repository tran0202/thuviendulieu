CREATE TABLE IF NOT EXISTS team_logo (
	id INT AUTO_INCREMENT PRIMARY KEY,
	team_id INT,
	logo_filename VARCHAR(255),
	start_date DATE,
	end_date DATE,
	FOREIGN KEY (team_id) REFERENCES team(id)
);

INSERT INTO team_logo (logo_filename, team_id)
VALUES ('ARI.svg', 33), ('ATL.svg', 34), ('BAL.svg', 35), ('BUF.svg', 36),
		('CAR.svg', 37), ('CHI.svg', 38), ('CIN.svg', 39), ('CLE.svg', 40),
		('DAL.svg', 41), ('DEN.svg', 42), ('DET.svg', 43),	('GB.svg', 44),
		('HOU.svg', 45), ('IND.svg', 46), ('JAX.svg', 47), ('KC.svg', 48),
		('LAC.svg', 49), ('LA.svg', 50), ('MIA.svg', 51), ('MIN.svg', 52),
		('NE.svg', 53), ('NO.svg', 54), ('NYG.svg', 55),	('NYJ.svg', 56),
		('OAK.svg', 57), ('PHI.svg', 58), ('PIT.svg', 59), ('SF.svg', 60),
		('SEA.svg', 61), ('TB.svg', 62), ('TEN.svg', 63), ('WAS.svg', 64),
	   ('ATM.png', 525), ('FCB.png', 526), ('BAY.png', 527), ('BRU.png', 528),
	   ('CSK.png', 529), ('DOR.png', 530), ('GAL.png', 531), ('TSG.png', 532),
	   ('INT.png', 533), ('JUV.png', 534), ('LIV.png', 535), ('LMO.png', 536),
	   ('LYO.png', 537), ('MCI.png', 538), ('MUN.png', 539), ('AMO.png', 540),
	   ('NAP.png', 541), ('PSG.png', 542), ('VPL.png', 543), ('POR.png', 544),
	   ('MAD.png', 545), ('ROM.png', 546), ('S04.png', 547), ('SHK.png', 548),
	   ('TOT.png', 549), ('VAL.png', 550), ('AEK.png', 551), ('AJA.png', 552),
	   ('BAT.png', 553), ('SLB.png', 554), ('CRV.png', 555), ('DZA.png', 556),
	   ('DYK.png', 557), ('PAO.png', 558), ('PSV.png', 559), ('RBS.png', 560),
	   ('VID.png', 561), ('YBO.png', 562), ('ASH.png', 563), ('APO.png', 564),
	   ('AST.png', 565), ('BAS.png', 566), ('CEL.png', 567), ('CFR.png', 568),
	   ('COR.png', 569), ('CRS.png', 570), ('DRI.png', 571), ('F91.png', 572),
	   ('SAC.png', 573), ('FEN.png', 574), ('FTA.png', 575), ('HBS.png', 576),
	   ('HJK.png', 577), ('KUK.png', 578), ('SPL.png', 579), ('LEG.png', 580),
	   ('LRI.png', 581), ('LUD.png', 582), ('MAL.png', 583), ('FCM.png', 584),
	   ('OLJ.png', 585), ('QAR.png', 586), ('ROS.png', 587), ('STI.png', 588),
	   ('SKE.png', 589), ('SLP.png', 590), ('SPM.png', 591), ('SPT.png', 592),
	   ('JUR.png', 593), ('STL.png', 594), ('SGR.png', 595), ('SUD.png', 596),
	   ('SUJ.png', 597), ('TNS.png', 598), ('KUT.png', 599), ('VFC.png', 600),
	   ('VRE.png', 601), ('VIK.png', 602), ('ZRI.png', 603);

INSERT INTO team_logo (logo_filename, team_id)
VALUES ('AKB.png', 604), ('ADL.png', 605), ('ARS.png', 606), ('BET.png', 607),
	   ('CHE.png', 608), ('SGE.png', 609), ('JAB.png', 610), ('KRA.png', 611),
	   ('LAZ.png', 612), ('B04.png', 613), ('OLM.png', 614), ('MIL.png', 615),
	   ('REN.png', 616), ('SLI.png', 617), ('VIL.png', 618), ('VPO.png', 619),
	   ('ZUR.png', 620), ('LAR.png', 621), ('APL.png', 622), ('ATT.png', 623),
	   ('BES.png', 624), ('BOR.png', 625), ('BIF.png', 626), ('BUR.png', 627),
	   ('SBU.png', 628), ('GNK.png', 629), ('GNT.png', 630), ('KOB.png', 631),
	   ('RBL.png', 632), ('MTA.png', 633), ('MOL.png', 634), ('OLY.png', 635),
	   ('PBE.png', 636), ('RFC.png', 637), ('RAV.png', 638), ('S08.png', 639),
	   ('SEV.png', 640), ('SIG.png', 641), ('TRN.png', 642), ('UFA.png', 643),
	   ('ZSP.png', 644), ('ZOR.png', 645), ('ABE.png', 646), ('ADM.png', 647),
	   ('AIK.png', 648), ('ANO.png', 649), ('ATR.png', 650), ('ATS.png', 651),
	   ('AZA.png', 652), ('B36.png', 653), ('BTO.png', 654), ('BAL.png', 655),
	   ('BNA.png', 656), ('BEJ.png', 657), ('BIR.png', 658), ('SBR.png', 659),
	   ('BUP.png', 660), ('CED.png', 661), ('CHS.png', 662), ('CLI.png', 663),
	   ('CFC.png', 664), ('CQN.png', 665), ('CSO.png', 666), ('DER.png', 667),
	   ('DRB.png', 668), ('DMI.png', 669), ('TBI.png', 670), ('DJU.png', 671),
	   ('DOM.png', 672), ('DAC.png', 673), ('DUN.png', 674), ('UEE.png', 675),
	   ('EUR.png', 676), ('FER.png', 677), ('FEY.png', 678), ('FHA.png', 679),
	   ('FOL.png', 680), ('FOG.png', 681), ('GAB.png', 682), ('GAN.png', 683),
	   ('GLE.png', 684), ('ZAB.png', 685), ('GZU.png', 686), ('HHA.png', 687),
	   ('HAC.png', 688), ('HAJ.png', 689), ('HIB.png', 690), ('BUH.png', 691),
	   ('IBV.png', 692), ('ILV.png', 693), ('IPA.png', 694), ('IBA.png', 695),
	   ('JAG.png', 696), ('KAI.png', 697), ('NOM.png', 698), ('KES.png', 699),
	   ('KIK.png', 700), ('KUP.png', 701), ('LAC.png', 702), ('LAH.png', 703),
	   ('LIN.png', 704), ('POZ.png', 705),
	   ('LET.png', 706), ('LSO.png', 707), ('LIE.png', 708), ('LSK.png', 709),
	   ('LUF.png', 710), ('LUZ.png', 711), ('MAR.png', 712), ('MRP.png', 713),
	   ('ORH.png', 714), ('BAK.png', 715), ('FCN.png', 716), ('RUN.png', 717),
	   ('OSI.png', 718), ('TIR.png', 719), ('HIN.png', 720), ('PRI.png', 721),
	   ('PRO.png', 722), ('PYU.png', 723), ('RAB.png', 724), ('RUL.png', 725),
	   ('RAD.png', 726), ('RIG.png', 727), ('RIJ.png', 728), ('RIO.png', 729),
	   ('PLJ.png', 730), ('RUV.png', 731), ('FCS.png', 732), ('SJU.png', 733),
	   ('SAR.png', 734), ('SSO.png', 735), ('SHR.png', 736), ('FKS.png', 737),
	   ('SIB.png', 738), ('SOF.png', 739), ('SKS.png', 740), ('SPP.png', 741),
	   ('SUB.png', 742), ('STG.png', 743), ('SJO.png', 744), ('UMF.png', 745),
	   ('KAU.png', 746), ('POD.png', 747), ('TOB.png', 748), ('FKT.png', 749),
	   ('NAR.png', 750), ('TRF.png', 751), ('UJP.png', 752), ('UNC.png', 753),
	   ('VAD.png', 754), ('VAR.png', 755), ('VEN.png', 756), ('VCO.png', 757),
	   ('VIT.png', 758), ('ZAL.png', 759), ('ZAR.png', 760), ('ZEL.png', 761);
