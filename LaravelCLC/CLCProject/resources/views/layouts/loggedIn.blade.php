<!--
Brady Berner & Pengyu Yin
CST-256
2-10-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

<!-- Checks to make sure that the user is logged in if they are not then all php execution is stopped and they're redirected
back to the home page -->
@if(!Session::has('ID'))
	<meta http-equiv="refresh" content="0; URL='/CLC'"/>
	<?php exit;?>
@endif