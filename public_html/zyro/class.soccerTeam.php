<?php

    class SoccerTeam {

        public static function getSoccerTeams($tournament) {

            $sql = self::getSoccerTeamSql($tournament->getTournamentId());
            self::getSoccerTeamDb($tournament, $sql);
        }

        /*
            SELECT UCASE(t.name) AS name, t.name AS l_name, tt.team_id,
                UCASE(t2.name) AS parent_team_name, t2.name AS l_parent_team_name, t.parent_team_id,
                group_id, UCASE(g.name) AS group_name, group_order,
                parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order,
                tl.logo_filename, n.flag_filename, n.code, tt.tournament_id
            FROM team_tournament tt
            LEFT JOIN team t ON t.id = tt.team_id
            LEFT JOIN team t2 ON t2.id = t.parent_team_id
            LEFT JOIN `group` g ON g.id = tt.group_id
            LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
            LEFT JOIN nation n ON n.id = t.nation_id
            LEFT JOIN team_logo tl ON tl.team_id = t.id
            WHERE tt.tournament_id = 1
            ORDER BY parent_group_name, group_id, group_order
        */

        public static function getSoccerTeamSql($tournament_id) {

            $sql = 'SELECT UCASE(t.name) AS name, t.name AS l_name, tt.team_id, 
                        UCASE(t2.name) AS parent_team_name, t2.name AS l_parent_team_name, t.parent_team_id,
                        group_id, UCASE(g.name) AS group_name, group_order, 
                        parent_group_id, pg.name AS parent_group_name, pg.long_name AS parent_group_long_name, parent_group_order, 
                        tl.logo_filename, n.flag_filename, n.code, tt.tournament_id 
                    FROM team_tournament tt 
                    LEFT JOIN team t ON t.id = tt.team_id  
                    LEFT JOIN team t2 ON t2.id = t.parent_team_id 
                    LEFT JOIN `group` g ON g.id = tt.group_id  
                    LEFT JOIN `group` pg ON pg.id = tt.parent_group_id
                    LEFT JOIN nation n ON n.id = t.nation_id  
                    LEFT JOIN team_logo tl ON tl.team_id = t.id 
                    WHERE tt.tournament_id = '.$tournament_id.' 
                    ORDER BY parent_group_name, group_id, group_order';
            return $sql;
        }

        public static function getSoccerTeamDb($tournament, $sql) {

            $query = $GLOBALS['connection']->prepare($sql);
            $query->execute();
            $count = $query->rowCount();
            $teams = array();
            $second_round_teams = array();
            $output = '<!-- Team Count = '.$count.' -->';

            if ($count == 0) {
                $output = '<h2>No result found!</h2>';
                $tournament->concatBodyHtml($output);
            }
            else {
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['name'], $row['l_name'], $row['code'],
                        $row['parent_team_id'], $row['parent_team_name'],
                        $row['group_name'], $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'],
                        $row['flag_filename'], $row['logo_filename'], '', 1);
                    array_push($teams, $team);

                    $second_round_team = Team::CreateSoccerTeam(
                        $row['team_id'], $row['name'], $row['l_name'], $row['code'],
                        $row['parent_team_id'], $row['parent_team_name'],
                        '', $row['group_order'],
                        $row['parent_group_name'], $row['parent_group_long_name'], $row['parent_group_order'],
                        $row['flag_filename'], $row['logo_filename'], '', 1);
                    array_push($second_round_teams, $second_round_team);
                }
                $tournament->setTeams($teams);
                $tournament->setSecondRoundTeams($second_round_teams);
                $tournament->concatBodyHtml($output);
            }
        }
    }
