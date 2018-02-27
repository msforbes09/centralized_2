<?php
/*
*/
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from  system");
	$stmt->execute();
	$content = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr title="'. $row["system_desc"] .'">';
		$content .= '<td><div class="system_update" id="system_' . $row["system_id"] . '">'. $row["system_name"] . '</div><a href="' . $row["system_address"] . '" target="_blank">' . $row["system_address"] .'</a></td>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<table class="table table-bordered">
	<thead class="bg-primary">
		<tr>
			<th>System List</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $content; ?>
	</tbody>
</table>