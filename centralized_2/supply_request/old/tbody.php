<?php
session_start();
//print_r($_REQUEST);

try {
	//Make class intance object...
	$pdo = new PDO( 'mysql:host=hrdapps40;dbname=forbes;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	//ASC/DESC
	$stmt = $pdo->prepare(
		"SELECT id,i_name,i_desc FROM supply_request
		WHERE
		
		u_name = :u_name
		and
		status = 0"
	);
	$stmt->bindValue(':u_name', $_SESSION["name"], PDO::PARAM_STR);
	$stmt->execute();
	echo '<h3>You have '. $stmt->rowCount() .' requested item/s.</h3>';
	//loop
	//[id,name,email,password,created_at];
	$tbody = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		//echo implode(',',$row);
		//echo '<hr>';
		$tbody .= '<tr>';
		$tbody .= '<td>'.$row["id"].'</td>';
		$tbody .= '<td>'.$row["i_name"].'</td>';
		$tbody .= '<td>'.$row["i_desc"].'</td>';
		//$tbody .= '<td>'.$row["u_name"].'</td>';
		//$tbody .= '<td>'.$row["status"].'</td>';
	}
 
} catch( PDOException $e ) {
	echo $e->getMessage();
}
//Destroy object
$pdo = null;
?>
<table class="table table-condensed table-bordered table-hover table-striped">
	<thead>
		<tr class="bg-warning">
			<th>Request ID</th>
			<th>Item Name</th>
			<th>Item Description</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody; ?>
	</tbody>
</table>