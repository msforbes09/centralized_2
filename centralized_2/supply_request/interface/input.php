<?php require_once 'server/get_category_list.php' ?>
<hr />
<div class="form-inline">
	<select id="select_category" class="form-control" style="width:250px;"><?php echo $category; ?></select>
	<select id="select_item" class="form-control" style="width:250px;"><?php require_once 'server/get_supply_list.php' ?></select>
	<input id="send_request" type="button" class="btn btn-success" value="Send" />
</div>