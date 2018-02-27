<?php
//print_r($_REQUEST);

try {
	//Make class intance object...
	$pdo = new PDO( 'mysql:host=hrdapps40;dbname=forbes;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	//ASC/DESC
	$stmt = $pdo->prepare(
		"SELECT id,u_name,i_name,i_desc FROM supply_request
		
		WHERE
		
		status = 0"
	);
	$stmt->execute();
	echo '<h3 class="pull-right">'. $stmt->rowCount() .' record/s found.</h3>';
	//loop
	//[id,name,email,password,created_at];
	$tbody = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		//echo implode(',',$row);
		//echo '<hr>';
		$tbody .= '<tr>';
		$tbody .= '<td>'.$row["id"].'</td>';
		$tbody .= '<td>'.$row["u_name"].'</td>';
		$tbody .= '<td>'.$row["i_name"].'</td>';
		$tbody .= '<td>'.$row["i_desc"].'</td>';
		$tbody .= '<td><button class="ok btn btn-xs btn-primary" id="ok-'.$row["id"].'"><span class="glyphicon glyphicon-ok"></span></button><button class="reject btn btn-xs btn-danger" id="reject-'.$row["id"].'"><span class="glyphicon glyphicon-remove"></span></button></td>';
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
			<th>Request Id</th>
			<th>Requestor</th>
			<th>Item Name</th>
			<th>Item Description</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody; ?>
	</tbody>
</table>