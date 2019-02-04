@extends('layouts.appmaster')
@section('title','Login')
<!--
Brady Berner & Pengyu Yin
CST-256
1-20-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->
@section('content')
<html>
	<body>
		<h1>Login</h1>
		
		<!-- Form to capture user login input -->
		<form action='loginHandler' method="POST">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			Username: <input type="text" name="username"><br>
			@if($errors->first('username') != null)
				<div style="color: red;">{{$errors->first('username')}}</div><br>
			@endif
			Password: <input type="password" name="password"><br>
			@if($errors->first('password') != null)
				<div style="color: red;">{{$errors->first('password')}}</div><br>
			@endif
			<button type="submit">Login</button>
		</form>
		
		<!-- Link to take user to registration page -->
		<a href="Register">Register Here</a>
	</body>
</html>
@endsection