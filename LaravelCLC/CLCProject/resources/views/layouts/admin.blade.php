@if(Session::has('ROLE'))
	@if(!session('ROLE'))
		<meta http-equiv="refresh" content="0; URL='/CLC'" />
		<?php exit;?>
	@endif
@endif