<?php
session_start();
	try{
	// make class instance object
	$pdo = new PDO('mysql:host=hrdapps40;dbname=forbes;charset=utf8;','root','admin');
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	
	$stmt = $pdo->prepare(
		"INSERT INTO supply_request
			(i_name,i_desc,u_name,status)
			VALUES
			(:i_name,:i_desc,:u_name,:status)
		"
	);
	$stmt->bindValue(':i_name', $_REQUEST["i_name"], PDO::PARAM_STR);
	$stmt->bindValue(':i_desc', $_REQUEST["i_desc"], PDO::PARAM_STR);
	$stmt->bindValue(':u_name', $_SESSION["name"], PDO::PARAM_STR);
	$stmt->bindValue(':status', $_REQUEST["status"], PDO::PARAM_STR);
	
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
//destroy object
$pdo = null; 