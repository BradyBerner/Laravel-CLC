<!--
Brady Berner & Pengyu Yin
CST-256
2-10-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

<!-- Checks to see if the user is logged in -->
@if(Session::has('ROLE'))
	<!-- If the user that's currently logged in is not an admin then it stop's php execution and redirects them back to the 
	home page -->
	@if(!session('ROLE'))
		<meta http-equiv="refresh" content="0; URL='/CLC'"/>
		<?php exit;?>
	@endif
<!-- If the user is not logged in then it stops php execution and redirects them to the home page -->
@else
	<meta http-equiv="refresh" content="0; URL='/CLC'"/>
	<?php exit;?>
@endif