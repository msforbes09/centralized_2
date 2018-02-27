<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		team.team_name as team_name,
		staff.first_name as first_name,
		staff.last_name as last_name,
		item_supply.item_name as item_name
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
		supply_request.availability = 1
	and
		supply_request.delivery_date = :date
	and
		supply_request.received_date is Null
	and
		team.section_id = :section
	order by
		staff.team,
		staff.staff_id,
		supply_request.request_id desc");
	$stmt->bindValue(':section', $_REQUEST["section"], PDO::PARAM_INT);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	$delivery = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$delivery .= '<tr>';
		$delivery .= '<td>' . $row["team_name"] . '</td>';
		$delivery .= '<td>' . $row["first_name"] . ' ' . $row["last_name"] . '</td>';
		$delivery .= '<td>' . $row["item_name"] . '</td>';
		$delivery .= '</tr>';
	}
/*
*/
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<h3><?php echo date("F j, Y"); ?></h3>
<table class="my_table">
	<thead>
		<tr>
			<th style="width: 20%;">Team</th>
			<th style="width: 40%;">Staff Name</th>
			<th style="width: 40%;">Requested Item</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $delivery; ?>
	</tbody>
</table>