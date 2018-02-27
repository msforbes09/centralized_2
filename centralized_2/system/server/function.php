<?php
function get_team_list($section){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from team where section_id = :section_id or section_id = 1");
	$stmt->bindValue(':section_id', $section, PDO::PARAM_INT);
	$stmt->execute();
	$team_list = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$team_list .= '<option value="' . $row["team_id"] . '">' . $row["team_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $team_list;
}
function get_job_desc($team_id){
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from job_desc where team_id = :team_id or team_id = 1");
	$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
	$stmt->execute();
	$job_desc = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$job_desc .= '<option value="' . $row["job_id"] . '">' . $row["job_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $job_desc;
}
function get_staff_list($team_id){
	$filter = '';
	if ($team_id != 1){
		$filter .= ' where team = ' . $team_id;
	}
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from staff $filter");
	$stmt->execute();
	$staff_list = '<option value="1"></option>';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$staff_list .= '<option value="' . $row["staff_id"] . '">' . $row["nick_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
	return $staff_list;
}
?>