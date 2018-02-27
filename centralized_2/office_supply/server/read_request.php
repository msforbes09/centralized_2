<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		supply_request.request_id as request_id,
		supply_request.availability as availability,
		supply_request.request_date as request_date,
		team.team_name as team_name,
		staff.staff_id as staff_id,
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
		supply_request.approval = 1
	and
		supply_request.received_date is Null
	and
		team.section_id = :section
	order by
		supply_request.availability,
		supply_request.request_date,
		staff.team,
		staff.staff_id,
		supply_request.request_id desc");
	$stmt->bindValue(':section', $_REQUEST["section"], PDO::PARAM_INT);
	$stmt->execute();
	$request = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$request .= '<tr class="' . compare($row["availability"],2,'bg-danger') . '">';
		$request .= '<td id="list_' . $row["request_id"] . '"><div class="item_name">' . $row["first_name"] . ' ' . $row["last_name"] . ' (' . $row["team_name"] . ') - ' . $row["item_name"] . '</div>';
		$request .= '<div class="item_desc">' . check_status($row["availability"]) . '</div></td>';
		$request .= '</tr>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
function compare($value,$compare,$return){
	if ($value == $compare){
		return $return;
	}
}
function check_status($availablity){
	$prompt = '';
	if ($availablity == 0){
		$prompt = 'Request Approved, Waiting for Delivery.';
		$prompt .= '<input type="button" class="btn btn-sm btn-danger btn_none pull-right" value="Not Available" />';
		$prompt .= '<input type="button" class="btn btn-sm btn-success btn_deliver pull-right" value="Delivered" />';
	} else if ($availablity == 2) {
		$prompt = 'Waiting for Availability.';
		$prompt .= '<input type="button" class="btn btn-sm btn-success btn_deliver pull-right" value="Delivered" />';
	} else {
		$prompt = 'Request Delivered, Waiting Confimation.';		
	}
	return $prompt;
	/*
	checking availability
	item is not available right now
	already delivered waiting confirmation
	*/
}
?>
<table class="my_table">
	<tbody>
		<?php echo $request; ?>
	</tbody>
</table>