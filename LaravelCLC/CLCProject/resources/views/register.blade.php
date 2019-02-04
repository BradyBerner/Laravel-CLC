@extends('layouts.appmaster')
@section('title','Register')
<!--
Brady Berner & Pengyu Yin
CST-256
1-20-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

@section('content')
<html>
	<body align="center">
		<h1>Register</h1>
		<!-- form to capture user registration input -->
		<form action="registrationHandler" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			First Name: <input type="text" name="firstname"/><br>
			@if($errors->first('firstname') != null)
				<div style="color: red;">{{$errors->first('firstname')}}</div><br>
			@endif
			Last Name: <input type="text" name="lastname"/><br>
			@if($errors->first('lastname') != null)
				<div style="color: red;">{{$errors->first('lastname')}}</div><br>
			@endif
			Email: <input type="text" name="email"/><br>
			@if($errors->first('email') != null)
				<div style="color: red;">{{$errors->first('email')}}</div><br>
			@endif
			Username: <input type="text" name="username"/><br>
			@if($errors->first('username') != null)
				<div style="color: red;">{{$errors->first('username')}}</div><br>
			@endif
			Password: <input type="text" name="password"/><br>
			@if($errors->first('password') != null)
				<div style="color: red;">{{$errors->first('password')}}</div><br>
			@endif
			<button type="submit">Register</button>
		</form>
	</body>
</html>
@endsection