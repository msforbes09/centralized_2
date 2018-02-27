<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		item_supply.item_name as item_name,
		supply_request.approval as approval,
		supply_request.received_date as received_date
	from
		supply_request,
		item_supply
	where
		supply_request.staff_id = :id
	and
		item_supply.item_id = supply_request.item_id
	and
		supply_request.received_date is not Null
	order by
		received_date desc");
	$stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
	$stmt->execute();
	$history = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$history .= '<tr ' . compare($row["approval"],2,'class="bg-danger"') . '>';
		$history .= '<td><div class="item_name">' . $row["item_name"] . '</div>';
		$history .= '<div class="item_desc">Confirmed : ' . $row["received_date"] . '</div></td>';
		$history .= '</tr>';
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
?>
<table class="my_table">
	<tbody>
		<?php echo $history; ?>
	</tbody>
</table>