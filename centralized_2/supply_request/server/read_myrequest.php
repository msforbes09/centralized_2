<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		supply_request.request_id as request_id,
		item_supply.item_name as item_name,
		supply_request.approval as approval,
		supply_request.availability as availability,
		supply_request.remark as remark
	from
		supply_request,
		item_supply
	where
		supply_request.staff_id = :id
	and
		item_supply.item_id = supply_request.item_id
	and
		supply_request.received_date is Null");
	$stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
	$stmt->execute();
	$request = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$request .= '<tr ' . compare($row["approval"],2,'class="bg-danger"') . '>';
		$request .= '<td id="list_' . $row["request_id"] . '"><div class="item_name">' . $row["item_name"] . '</div>';
		$request .= '<div class="item_desc">' . check_status($row["approval"],$row["availability"],$row["remark"]) . '</div></td>';
		$request .= '</tr>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
function check_status($approval,$availability,$remark){
	$prompt = '';
	if ($approval == 0){
		$prompt = 'Request sent, Waiting approval.';
	} else if ($approval == 1){
		if ($availability == 0){
			$prompt = 'Request approved, Checking availability.';
		} else if ($availability == 1){
			$prompt = 'Your request is delivered.';
			$prompt .= '<input type="button" class="btn btn-sm btn-danger confirm_request pull-right" value="Confirm" />';
		} else if ($availability == 2){
			$prompt = 'Your request is not available right now.';
		}
	} else if ($approval == 2){
		$prompt = 'Your request is disapproved. ';
		$prompt .= 'Reason : ' . $remark;
		$prompt .= '<input type="button" class="btn btn-sm btn-danger clear_request pull-right" value="Clear" />';
	}
	return $prompt;
	/*
	request sent,waiting approval
	request approved, checking availability
	request not approved, need note, please confirm
	item is not available right now
	item is available, already delivered
	item delivered, please confirm
	*/
}
function compare($value,$compare,$return){
	if ($value == $compare){
		return $return;
	}
}
?>
<table class="my_table">
	<tbody>
		<?php echo $request; ?>
	</tbody>
</table>