<?php
$col = $_REQUEST["col"];
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"insert into system_user 
			(system_id, $col)
		values
			(:system_id, :val)");
	$stmt->bindValue(':val', $_REQUEST["val"], PDO::PARAM_STR);
	$stmt->bindValue(':system_id', $_REQUEST["system_id"], PDO::PARAM_STR);
	$stmt->execute();
}catch( PDOException $e ){
	echo $e->getMessage();
}
$pdo = null;
?>