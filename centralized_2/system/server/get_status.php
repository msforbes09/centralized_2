<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from employment_status");
	$stmt->execute();
	$e_stat = '<select id="input_status" class="form-control">';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$e_stat .= '<option value="' . $row["status_id"] . '">' . $row["status_desc"] . '</option>';
	}
	$e_stat .= '</select>';
	echo $e_stat;
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>