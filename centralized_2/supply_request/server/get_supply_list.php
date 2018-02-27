<?php
if ($_REQUEST["category"] != 0){
	$filter = 'where item_category = ' . $_REQUEST["category"];
}
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from item_supply $filter order by item_category");
	$stmt->execute();
	$supply = '<option value="0"></option>';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$supply .= '<option value="' . $row["item_id"] . '">' . $row["item_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
echo $supply;
?>
