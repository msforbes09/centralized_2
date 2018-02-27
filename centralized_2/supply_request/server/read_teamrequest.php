<?php
/*
print_r ($_REQUEST);
*/
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		supply_request.request_id as request_id,
		staff.first_name as first_name,
		staff.last_name as last_name,
		item_supply.item_name as item_name,
		supply_request.approval as approval,
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
		supply_request.received_date is Null
	order by
		supply_request.approval,
		supply_request.request_date,
		staff.staff_id,
		supply_request.request_id desc	");
	$stmt->bindValue(':team', $_REQUEST["team"], PDO::PARAM_INT);
	$stmt->execute();
	$request = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$request .= '<tr>';
		$request .= '<td id="list_' . $row["request_id"] . '"><div class="item_name">' . $row["first_name"] . ' ' . $row["last_name"] . ' - ' . $row["item_name"] . '</div>';
		$request .= '<div class="item_desc">' . check_status($row["approval"], $row["availability"], $row["received_date"]) . '</div></td>';
		$request .= '</tr>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
function check_status($approved,$availability,$received){
	$prompt = '';
	if($approved == 0){
		$prompt = 'Waiting for your Approval.';
		$prompt .= '<input type="button" class="btn btn-sm btn-danger btn_disapprove pull-right" value="Disapprove" />';
		$prompt .= '<input type="button" class="btn btn-sm btn-success btn_approve pull-right" value="Approve" />';
	} else if($approved == 2){
		$prompt = 'Request disapproved, Waiting Confimation.';	
	} else {
		if ($availability == 0){
			$prompt = 'Checking availability.';
		} else if ($availability == 1 && is_null($received) ){
			$prompt = 'Request delivered, Waiting confirmation.';
		} else if ($availability == 2){
			$prompt = 'Item is not available right now.';
		}
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