@extends('layouts.appmaster')
@section('title','Register')
<!--
Brady Berner & Pengyu Yin
CST-256
1-20-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

@section('content')
		<!-- form to capture user registration input -->
		<form action="registrationHandler" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			<div class="form-group">
				<label for="fname">First Name: </label>
				<input type="text" class="form-control" id="fname" style="width:20%;" name="firstname"/><br>
				@if($errors->first('firstname') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('firstname')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="lname">Last Name: </label>
				<input type="text" class="form-control" id="lname" style="width:20%;" name="lastname"/><br>
				@if($errors->first('lastname') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('lastname')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="email">Email: </label>
				<input type="text" class="form-control" id="email" style="width:20%;" name="email"/><br>
				@if($errors->first('email') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('email')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="uname">Username: </label>
				<input type="text" class="form-control" id="uname" style="width:20%;" name="username"/><br>
				@if($errors->first('username') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('username')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="pword">Password: </label>
				<input type="text" class="form-control" id="pword" style="width:20%;" name="password"/><br>
				@if($errors->first('password') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('password')}}</div>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Register</button>
		</form>
@endsection