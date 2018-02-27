<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from item_category");
	$stmt->execute();
	$option = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$option .= '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>
<input id="item_name" type="text" class="form-control" />
<select id="item_cate" class="form-control">
	<?php echo $option; ?>
</select>
<hr />
<p>Please input item (<i>item name-item description</i>) Example : <b>highlighter-pink</b></p>
<div id="show_error" style="color: red; text-align: center; font-size: 15px; margin-top: 15px;"></div>