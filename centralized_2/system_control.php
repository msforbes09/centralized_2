<?php
session_start();
if( is_null($_SESSION["id"]) )  {
	header('location: http://hrdapps40/forbes/log_in');
} else {
/*
*/
	try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(//get staff data
	"select
		staff.first_name as first_name,
		staff.middle_name as middle_name,
		staff.last_name as last_name,
		staff.employment_stat as status,
		staff.job_cate as job_category,
		staff.job_desc as job_desc,
		team.team_name as team_name,
		staff.team as team,
		team.section_id as section,
		section.section_name as section_name,
		staff.image as image
	from
		staff,
		team,
		section
	where
		staff_id = :id
	and
		team.team_id = staff.team
	and
		section.section_id = team.section_id");
	$stmt->bindValue(':id', $_SESSION["id"], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = $pdo->prepare(
	"select * from
		system,
		system_user
	where
		system_user.system_id = system.system_id
	and
		system.system_address like :address
	and
		(system_user.staff_id = :id
	or
		system_user.status_id = :status
	or
		system_user.job_category_id = :job_category
	or
		system_user.job_desc_id = :job_desc
	or
		system_user.team_id = :team
	or
		system_user.section_id = :section)");
	$stmt->bindValue(':address', '%' . $_SERVER["REQUEST_URI"], PDO::PARAM_INT);
	$stmt->bindValue(':id', $_SESSION["id"], PDO::PARAM_INT);
	$stmt->bindValue(':status', $row["status"], PDO::PARAM_INT);
	$stmt->bindValue(':job_category', $row["job_category"], PDO::PARAM_INT);
	$stmt->bindValue(':job_desc', $row["job_desc"], PDO::PARAM_INT);
	$stmt->bindValue(':team', $row["team"], PDO::PARAM_INT);
	$stmt->bindValue(':section', $row["section"], PDO::PARAM_INT);
	$stmt->execute();
	if (!$stmt->rowCount()){
		header('location: http://hrdapps40/forbes/redirect.php');
		//echo 'not allowed';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
$team = $row["team"];
$team_name = $row["team_name"];
$id = $_SESSION["id"];
$name = $row["first_name"] . ' ' . $row["last_name"];
$section = $row["section"];
$section_name = $row["section_name"];
}
?>