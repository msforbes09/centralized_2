<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from item_category");
	$stmt->execute();
	$category = '<option value="0">ALL</option>';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$category .= '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
	}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>