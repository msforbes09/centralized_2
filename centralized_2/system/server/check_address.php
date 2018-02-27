<?php
/*
*/
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from system where system_address = :address");
	$stmt->bindValue(':address', $_REQUEST["address"], PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount();
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>