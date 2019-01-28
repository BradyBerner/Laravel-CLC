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
			First Name: <input type="text" name="fname"/><br>
			Last Name: <input type="text" name="lname"/><br>
			Email: <input type="text" name="email"/><br>
			Username: <input type="text" name="username"/><br>
			Password: <input type="text" name="password"/><br>
			<button type="submit">Register</button>
		</form>
	</body>
</html>