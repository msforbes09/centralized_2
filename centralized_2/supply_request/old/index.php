<?php
		require_once '../../homes/home/control.php';
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Supplies Ordering</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		
		<br><br>
		
		<div class="container-fluid">
		<h1>Foundation Design Supplies Ordering Portal</h1>
		</div>
		
		<div class="container-fluid">
		<br><br>
		<h1><font face="constantia">What do you need<b><i>&nbsp;&nbsp; <?php echo $_SESSION["name"] ?>?</i></b></font></h1>
		</div><br><br>
		<div class="alert alert-success" role="alert">
			<h3><i><font face="constantia"><center><?php
		require_once 'user_note.php';
?><center></font></i></h3></div><br><br>
		<div class="container-fluid bg-default">
		<table>
		<tr>
		<td width="300px"><input class="form-control input-md" type="text" id="i_name"  placeholder="Item Name" class="a"></td>
		<td width="300px"><input class="	form-control input-md" type="text" id="i_desc" placeholder="Item Description" class="a"></td>
		<td width="100px"><button class="btn btn-warning btn-md" id="save">Save</button></td>
		</tr>
		</table>
		</div>
		<div id="content"></div>
		
		
		
		<script src="../bootstrap/js/jquery-1.11.3.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="index.js"></script>
	</body>
</html>