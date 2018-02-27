<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from section");
	$stmt->execute();
	$section = '';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$section .= '<option value="' . $row["section_id"] . '">' . $row["section_name"] . '</option>';
	}
	echo $section;
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>