<?php
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setattribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
	"select * from logs
	where
	log_id = :log_id
	and
	date = :date");
	$stmt->bindValue(':log_id', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);	
	$stmt->execute();
	if(!$stmt->rowCount()){
		$stmt = $pdo->prepare(
			"INSERT INTO logs
				(log_id,date,time)
				VALUES
				(:log_id,:date,:time)");
		$stmt->bindValue(':log_id', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
		$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);	
		$stmt->bindValue(':time', date("H:i:s"), PDO::PARAM_STR);	
		$stmt->execute();
	}
}catch( PDOException $e ){
	echo $e->getMessage();
	
}
$pdo = null; 
?>