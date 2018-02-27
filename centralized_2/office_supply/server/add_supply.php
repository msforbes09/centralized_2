<?php
/*
print_r ($_REQUEST);
*/
	try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO item_supply
			(item_name, item_category)
			VALUES
			(:item_name, :item_category)");
	$stmt->bindValue(':item_name', $_REQUEST["item_name"], PDO::PARAM_STR);
	$stmt->bindValue(':item_category', $_REQUEST["item_cate"], PDO::PARAM_INT);
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
$pdo = null; 
?>