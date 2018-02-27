<?php
	try {
		$pdo = new PDO( 'mysql:host=hrdapps40;dbname=forbes;charset=utf8;', 'root', 'admin' );
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$stmt = $pdo->prepare(
			"SELECT supply_admin FROM note_table
			WHERE
			
			id = 1"
		);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		print $row["supply_admin"];
	 
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
	$pdo = null;
?>