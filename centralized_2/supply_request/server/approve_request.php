<?php
/*
print_r ($_REQUEST);
*/
	try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"update supply_request
		set
			approval = :value,
			approval_date = :date,
			remark = :comment
		where
			request_id = :data_id");
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->bindValue(':value', $_REQUEST["value"], PDO::PARAM_INT);
	$stmt->bindValue(':comment', $_REQUEST["comment"], PDO::PARAM_STR);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
$pdo = null; 
?>