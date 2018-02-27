<?php
try {
	$pdo = new PDO( 'mysql:host=localhost;dbname=centralized;charset=utf8;', 'root', 'admin' );
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $pdo->prepare(
	"select * from job_category");
	$stmt->execute();
	$job_cate = '<select id="input_position" class="form-control">';
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$job_cate .= '<option value="' . $row["category_id"] . '">' . $row["category_desc"] . '</option>';
	}
	$job_cate .= '</select>';
	echo $job_cate;
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}
$pdo = null;
?>


