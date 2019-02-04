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
		
		<!-- Form to capture user login input -->
		<form action='loginHandler' method="POST">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			<div class="form-group">
				<label for="uname">Username: </label>
				<input type="text" class="form-control" id="uname" style="width:20%;" name="username"><br>
				@if($errors->first('username') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('username')}}</div><br>
				@endif
			</div>
			<div class="form-group">
				<label for="pword">Password: </label>
				<input type="password" class="form-control" id="pword" style="width:20%;" name="password"><br>
				@if($errors->first('password') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('password')}}</div><br>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
		
		<!-- Link to take user to registration page -->
		<a href="Register">Register Here</a>
	</body>
</html>
@endsection