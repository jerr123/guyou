


	<?php 
	if (isset($_scripts))
	foreach ($_scripts as $_script_path) {
		echo '<script type="text/javascript" src="'.base_url('public/js/'.$_script_path).'.js"></script>';
	} 
	?>
	
</body>
</html>