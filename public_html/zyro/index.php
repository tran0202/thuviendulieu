<?php
	error_reporting(E_ALL); @ini_set('display_errors', true);
	$pages = array(
		'0'	=> array('id' => '1', 'alias' => '', 'file' => 'home.php','controllers' => array()),
		'1'	=> array('id' => '2', 'alias' => 'Soccer', 'file' => 'soccer.php','controllers' => array()),
        '2'	=> array('id' => '3', 'alias' => 'SoccerGroups', 'file' => 'soccer_groups.php','controllers' => array()),
        '3'	=> array('id' => '4', 'alias' => 'SoccerSchedule', 'file' => 'soccer_schedule.php','controllers' => array()),
        '4'	=> array('id' => '5', 'alias' => 'WorldCup', 'file' => 'world_cup_tournament.php','controllers' => array()),
        '5'	=> array('id' => '6', 'alias' => 'WorldCupArchive', 'file' => 'world_cup_archive.php','controllers' => array()),
        '6'	=> array('id' => '7', 'alias' => 'WorldCupQualification', 'file' => 'world_cup_qualification.php','controllers' => array()),
        '7'	=> array('id' => '8', 'alias' => 'UEFANationsLeagueStandings', 'file' => 'uefa_nations_league_standings.php','controllers' => array()),
        '8'	=> array('id' => '9', 'alias' => 'UEFANationsLeagueMatches', 'file' => 'uefa_nations_league_matches.php','controllers' => array()),
        '9'	=> array('id' => '10', 'alias' => 'UEFAChampionsLeagueStandings', 'file' => 'uefa_champions_league_standings.php','controllers' => array()),
        '10'	=> array('id' => '11', 'alias' => 'UEFAChampionsLeagueMatches', 'file' => 'uefa_champions_league_matches.php','controllers' => array()),
        '11'	=> array('id' => '12', 'alias' => 'UEFAEuropaLeagueStandings', 'file' => 'uefa_europa_league_standings.php','controllers' => array()),
        '12'	=> array('id' => '13', 'alias' => 'UEFAEuropaLeagueMatches', 'file' => 'uefa_europa_league_matches.php','controllers' => array()),
        '13'	=> array('id' => '14', 'alias' => 'WomenWorldCup', 'file' => 'women_world_cup_tournament.php','controllers' => array()),
        '14'	=> array('id' => '15', 'alias' => 'WomenWorldCupArchive', 'file' => 'women_world_cup_archive.php','controllers' => array()),
        '15'	=> array('id' => '16', 'alias' => 'OlympicFootballTournament', 'file' => 'olympic_football_tournament.php','controllers' => array()),
        '16'	=> array('id' => '17', 'alias' => 'OlympicFootballTournamentArchive', 'file' => 'olympic_football_archive.php','controllers' => array()),
        '17'	=> array('id' => '18', 'alias' => 'WomenOlympicFootballTournament', 'file' => 'women_olympic_football_tournament.php','controllers' => array()),
        '18'	=> array('id' => '19', 'alias' => 'WomenOlympicFootballTournamentArchive', 'file' => 'women_olympic_football_archive.php','controllers' => array()),
        '19'	=> array('id' => '20', 'alias' => 'Euro', 'file' => 'euro_tournament.php','controllers' => array()),
        '20'	=> array('id' => '21', 'alias' => 'EuroArchive', 'file' => 'euro_archive.php','controllers' => array()),
        '21'	=> array('id' => '22', 'alias' => 'CopaAmerica', 'file' => 'copa_america_tournament.php','controllers' => array()),
        '22'	=> array('id' => '23', 'alias' => 'CopaAmericaArchive', 'file' => 'copa_america_archive.php','controllers' => array()),
        '23'	=> array('id' => '24', 'alias' => 'GoldCup', 'file' => 'gold_cup_tournament.php','controllers' => array()),
        '24'	=> array('id' => '25', 'alias' => 'GoldCupArchive', 'file' => 'gold_cup_archive.php','controllers' => array()),
        '25'	=> array('id' => '26', 'alias' => 'AfricaCup', 'file' => 'africa_cup_tournament.php','controllers' => array()),
        '26'	=> array('id' => '27', 'alias' => 'AfricaCupArchive', 'file' => 'africa_cup_archive.php','controllers' => array()),
        '27'	=> array('id' => '28', 'alias' => 'AsianCup', 'file' => 'asian_cup_tournament.php','controllers' => array()),
        '28'	=> array('id' => '29', 'alias' => 'AsianCupArchive', 'file' => 'asian_cup_archive.php','controllers' => array()),
        '29'	=> array('id' => '30', 'alias' => 'OFCNationsCup', 'file' => 'ofc_nations_cup_tournament.php','controllers' => array()),
        '30'	=> array('id' => '31', 'alias' => 'OFCNationsCupArchive', 'file' => 'ofc_nations_cup_archive.php','controllers' => array()),
        '31'	=> array('id' => '32', 'alias' => 'ConfederationsCup', 'file' => 'confederations_cup_tournament.php','controllers' => array()),
        '32'	=> array('id' => '33', 'alias' => 'ConfederationsCupArchive', 'file' => 'confederations_cup_archive.php','controllers' => array()),
        '33'	=> array('id' => '34', 'alias' => 'NFL', 'file' => 'football.php','controllers' => array()),
        '34'	=> array('id' => '35', 'alias' => 'NFLStandings', 'file' => 'football_standings.php','controllers' => array()),
        '35' => array('id' => '36', 'alias' => 'Tennis', 'file' => 'tennis.php','controllers' => array()),
        '36' => array('id' => '37', 'alias' => 'TennisTournament', 'file' => 'tennis_tournament.php','controllers' => array())
//		'4'	=> array('id' => '4', 'alias' => 'New-Link', 'file' => 'tennis.php','controllers' => array())
	);
	$forms = array(

	);
	$langs = null;
	$def_lang = null;
	$base_lang = 'en';
	$site_id = "c4385798";
	$base_dir = dirname(__FILE__);
	$base_url = '/';
	$user_domain = 'thuviendulieu.000webhostapp.com';
	$show_comments = false;
	require_once dirname(__FILE__).'/functions.inc.php';
	$home_page = '1';
	list($page_id, $lang, $urlArgs, $route) = parse_uri();
	$user_key = "pNVYNrtBIOTYJFaGqd83ps11DM4pEEoST7yfvK1neg==";
	$user_hash = "7dd34957db42e2cc";
	$comment_callback = "http://us.zyro.com/comment_callback/";
	$preview = false;
	$mod_rewrite = true;
	$page = isset($pages[$page_id]) ? $pages[$page_id] : null;
	$hr_out = '';
	if (!is_null($page)) {
		handleComments($page['id']);
		if (isset($_POST["wb_form_id"])) handleForms($page['id']);
	}
	ob_start();
	if ($page) {
		$fl = dirname(__FILE__).'/'.$page['file'];
		if (is_file($fl)) {
			ob_start();
			include $fl;
			$out = ob_get_clean();
			$ga_out = '';
			if ($lang && $langs) {
				foreach ($langs as $ln => $default) {
					$pageUri = getPageUri($page['id'], $ln);
					$out = str_replace(urlencode('{{lang_'.$ln.'}}'), $pageUri, $out);
				}
			}
			if (is_file($ga_file = dirname(__FILE__).'/ga_code') && $ga_code = file_get_contents($ga_file)) {
				$ga_out = str_replace('{{ga_code}}', $ga_code, file_get_contents(dirname(__FILE__).'/ga.html'));
			}
			$out = str_replace('{{ga_code}}', $ga_out, $out);
			$baseUrl = (isHttps() ? 'https' : 'http').'://'.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost').'/';
			$out = str_replace('{{base_url}}', $baseUrl, $out);
			$out = str_replace('{{curr_url}}', $baseUrl.($lang && $lang != $def_lang ? $lang.'/' : '').$route, $out);
			$out = str_replace('{{hr_out}}', $hr_out, $out);
			header('Content-type: text/html; charset=utf-8', true);
			echo $out;
		}
	} else {
		header("Content-type: text/html; charset=utf-8", true, 404);
		if (is_file(dirname(__FILE__).'/404.html')) {
			include '404.html';
		} else {
			echo "<!DOCTYPE html>\n";
			echo "<html>\n";
			echo "<head>\n";
			echo "<title>404 Not found</title>\n";
			echo "</head>\n";
			echo "<body>\n";
			echo "404 Not found\n";
			echo "</body>\n";
			echo "</html>";
		}
	}
	ob_end_flush();

?>