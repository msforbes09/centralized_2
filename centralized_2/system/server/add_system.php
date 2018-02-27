<?php
/*
print_r ($_REQUEST);
*/
	try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO system
			(system_address,system_name,system_desc)
			VALUES
			(:address,:name,:desc)");
	$stmt->bindValue(':address', $_REQUEST["address"], PDO::PARAM_STR);
	$stmt->bindValue(':name', $_REQUEST["name"], PDO::PARAM_STR);
	$stmt->bindValue(':desc', $_REQUEST["desc"], PDO::PARAM_STR);
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
}
$pdo = null; 
?>