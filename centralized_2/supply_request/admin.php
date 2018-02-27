<?php require_once '../../forbes/system_control.php'?>
<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="">
		<title>Request Approval</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="sheet/general.css" rel="stylesheet">
	</head>
	<body>
		<input type="hidden" id="team_id" value="<?php echo $team; ?>" />
		<div class="container-fluid">
			<h3>Team Requests ( <?php echo $team_name; ?> )</h3>
			<hr />
			<table style="width: 100%;">
				<tr>
					<th><h4>Requests :</h4></th>
					<th><h4>History :</h4></th>
				</tr>
				<tr>
					<td style="width: 50%; vertical-align: top; padding: 5px;">
						<div id="request" style="height: 770px;"></div>
					</td>
					<td style="width: 50%; vertical-align: top; padding: 5px;">
						<div id="history" style="height: 770px;"></div>
					</td>
				</tr>
			</table>
		</div>
		<?php require_once 'interface/modal.php'; ?>
		<script src="../bootstrap/js/jquery-3.2.1.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="script/admin.js"></script>
	</body>
</html>
