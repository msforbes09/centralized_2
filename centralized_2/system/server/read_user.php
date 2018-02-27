<?php
/*
*/
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		staff.nick_name as staff,
		employment_status.status_desc as status,
		job_category.category_desc as job_category,
		job_desc.job_name as job_desc,
		team.team_name as team,
		section.section_name as section
	from
		system_user,
		staff,
		employment_status,
		job_category,
		job_desc,
		team,
		section
	where
		system_id = :data_id
	and
		system_user.staff_id = staff.staff_id
	and
		system_user.status_id = employment_status.status_id
	and
		system_user.job_category_id = job_category.category_id
	and
		system_user.job_desc_id = job_desc.job_id
	and
		system_user.team_id = team.team_id
	and
		system_user.section_id = section.section_id
		");
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->execute();
	$content = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr>';
		$content .= '<td>' . $row["staff"] . '</td>';
		$content .= '<td>' . $row["status"] . '</td>';
		$content .= '<td>' . $row["job_category"] . '</td>';
		$content .= '<td>' . $row["job_desc"] . '</td>';
		$content .= '<td>' . $row["team"] . '</td>';
		$content .= '<td>' . $row["section"] . '</td>';
		$content .= '</tr>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<table class="table table-bordered">
	<thead class="bg-primary">
		<tr>
			<th id="add_staff" style="width:16.6%">Staff</th>
			<th id="add_status" style="width:16.6%">Employment Status</th>
			<th id="add_position" style="width:16.6%">Position</th>
			<th id="add_job" style="width:16.6%">Job Desc</th>
			<th id="add_team" style="width:16.6%">Team</th>
			<th id="add_section" style="width:16.6%">Section</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $content; ?>
	</tbody>
</table>