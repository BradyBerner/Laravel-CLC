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
		<title>Register</title>
	</head>
	
	<body align="center">
		<h1>Register</h1>
		<!-- form to capture user registration input -->
		<form action="registrationHandler" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			First Name: <input type="text" name="fname"/><br><?php echo "<div style='color:red;'>".$errors->first('fname')."</div><br>"?>
			Last Name: <input type="text" name="lname"/><br><?php echo "<div style='color:red;'>".$errors->first('lname')."</div><br>"?>
			Email: <input type="text" name="email"/><br><?php echo "<div style='color:red;'>".$errors->first('email')."</div><br>"?>
			Username: <input type="text" name="username"/><br><?php echo "<div style='color:red;'>".$errors->first('username')."</div><br>"?>
			Password: <input type="text" name="password"/><br><?php echo "<div style='color:red;'>".$errors->first('password')."</div><br>"?>
			<button type="submit">Register</button>
		</form>
	</body>
</html>