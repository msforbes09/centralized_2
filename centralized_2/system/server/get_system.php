<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from  system where system_id = :data_id");
	$stmt->bindValue(':data_id', $_REQUEST["data_id"], PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$system = 'Name: ' . $row["system_name"]. '<br />';
	$system .= 'Address: ' . $row["system_address"]. '<br />';
	$system .= 'Description: ' . $row["system_desc"];
	$system .= '<input type="hidden" id="system_id" value="' . $row["system_id"] . '" />';
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
echo $system;
?>