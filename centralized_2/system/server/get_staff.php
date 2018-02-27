<select id="select_section" class="form-control">
	<?php
		require_once 'read_section.php';
		require_once 'function.php';
	?>
</select>
<select id="select_team_1" class="form-control">
	<?php
		echo get_team_list(1);
	?>
</select>
<select id="input_staff" class="form-control">
	<?php
		echo get_staff_list(1);
	?>
</select>