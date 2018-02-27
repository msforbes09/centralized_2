<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		team.team_name as team_name,
		staff.first_name as first_name,
		staff.last_name as last_name,
		item_supply.item_name as item_name,
		supply_request.received_date as received_date
	from
		staff,
		item_supply,
		team,
		supply_request
	where
		staff.staff_id = supply_request.staff_id
	and
		item_supply.item_id = supply_request.item_id
	and
		team.team_id = staff.team
	and
		supply_request.approval = 1
	and
		supply_request.received_date is not Null
	and
		team.section_id = :section
	order by
		supply_request.received_date desc,
		staff.team,
		staff.staff_id,
		supply_request.request_id desc");
	$stmt->bindValue(':section', $_REQUEST["section"], PDO::PARAM_INT);
	$stmt->execute();
	$waiting = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$waiting .= '<tr>';
		$waiting .= '<td><div class="item_name">' . $row["item_name"] . '</div>';
		$waiting .= '<div class="item_desc">' . $row["team_name"] . ' - ' . $row["first_name"] . ' ' . $row["last_name"] . ' / ';
		$waiting .= 'Received : ' . $row["received_date"] . '</td>';
		$waiting .= '</tr>';
	}
/*
*/
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<table class="my_table">
	<tbody>
		<?php echo $waiting; ?>
	</tbody>
</table>