 <?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select
		item_supply.item_name as item_name,
		item_category.category_name as item_category
	from
		item_supply,
		item_category
	where
		item_supply.item_category = item_category.category_id
	order by
		item_supply.item_category");
	$stmt->execute();
	echo $stmt->rowCount() . ' item/s found.';
	$content = '';
	$count = 1;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$content .= '<tr>';
		$content .= '<td>'. $count .'.</td>';
		$content .= '<td>'. $row["item_name"] .'</td>';
		$content .= '<td>'. $row["item_category"] .'</td>';
		$content .= '</tr>';
		$count += 1;
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<table class="table table-bordered">
	<thead class="bg-primary">
		<tr>
			<th>No.</th>
			<th>Item Name</th>
			<th>Item Category</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $content; ?>
	</tbody>
</table>