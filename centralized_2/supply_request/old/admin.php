<?php
		require_once '../../homes/home/control.php';
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Request Approval</title>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<!--<button id="test">test</button>-->
		
		<div class="container-fluid">
			<h1>Request Approval Form</h1>
			
			<button id="note" class="btn btn-warning btn-md">Note<span class= "glyphicon glyphicon-paperclip"></span></button><br><br>
			<div class="alert alert-warning" role="alert">
			<h3><i><font face="constantia"><center><?php
		require_once 'user_note.php';
?><center></font></i></h3></div><br><br>
			<hr> 
			<div id="content"></div>
			
			<!-- Modal -->
			<div class="modal fade">
			  <div class="modal-dialog modal-md">
				<div class="modal-content">
				  <div class="modal-header bg-danger">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Modal title</h4>
				  </div>
				  <div class="modal-body"></div>
				  <div class="modal-footer"></div>
				</div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			
		</div>
			<script src="../bootstrap/js/jquery-1.11.3.js"></script>
			<script src="../bootstrap/js/bootstrap.min.js"></script>
			<script src="admin.js"></script>
	</body>
</html>