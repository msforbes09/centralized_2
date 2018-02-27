<?php
	//print_r($_REQUEST);
	
	try{
	// make class instance object
	$pdo = new PDO('mysql:host=hrdapps40;dbname=forbes;charset=utf8;','root','admin');
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	
	$stmt = $pdo->prepare(
		"UPDATE supply_request 
			Set
			status = 2
			where 
			id = :id
		"
	);
	$stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
	
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
//destroy object
$pdo = null;