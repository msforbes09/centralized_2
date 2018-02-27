<?php
/*
print_r ($_REQUEST);
*/
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		staff.first_name as first_name,
		staff.last_name as last_name,
		item_supply.item_name as item_name,
		supply_request.availability as availability,
		supply_request.received_date as received_date
	from
		staff,
		item_supply,
		supply_request
	where
		staff.staff_id = supply_request.staff_id
	and
		item_supply.item_id = supply_request.item_id
	and
		staff.team = :team
	and
		supply_request.approval = 1
	and
		supply_request.received_date is not Null
	order by
		supply_request.received_date desc,
		staff.team,
		staff.staff_id,
		supply_request.request_id desc");
	$stmt->bindValue(':team', $_REQUEST["team"], PDO::PARAM_INT);
	$stmt->execute();
	$history = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$history .= '<tr>';
		$history .= '<td><div class="item_name">' . $row["first_name"] . ' ' . $row["last_name"] . ' - ' . $row["item_name"] . '</div>';
		$history .= '<div class="item_desc">Received : ' . $row["received_date"] . '<div></td>';
		$history .= '</tr>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
function check_status($availability,$received){
	$prompt = '';
	if ($availability == 0){
		$prompt = 'Checking availability.';
	} else if ($availability == 1 && is_null($received) ){
		$prompt = 'Request delivered, Waiting confirmation.';
	} else if ($availability == 2){
		$prompt = 'Item is not available right now.';
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
		<?php echo $history; ?>
	</tbody>
</table>