<select id="select_section" class="form-control">
	<?php
		require_once 'read_section.php';
	?>
</select>
<select id="input_team" class="form-control">
	<?php
		require_once 'function.php';
		echo get_team_list(1);
	?>
</select>