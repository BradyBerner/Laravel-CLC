<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
?>

<html>
	<head>
		<title>Login</title>
	</head>

	<body align="center">
		<h1>Login</h1>
		
		<!-- Form to capture user login input -->
		<form action='loginHandler' method="POST">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			Username: <input type="text" name="username"><br><?php echo "<div style='color:red;'>".$errors->first('username')."</div><br>"?>
			Password: <input type="password" name="password"><br><?php echo "<div style='color:red;'>".$errors->first('password')."</div><br>"?>
			<button type="submit">Login</button>
		</form>
		
		<!-- Link to take user to registration page -->
		<a href="Register">Register Here</a>
	</body>
</html>