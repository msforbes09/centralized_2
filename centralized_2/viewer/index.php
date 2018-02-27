<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from logs
	where
	date = :date");
	$stmt->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount() . ' viewer/s<br />' ;
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		echo $row["log_id"] . '<br />';
		}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>