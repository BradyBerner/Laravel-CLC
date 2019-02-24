@include('layouts.admin')
@extends('layouts.appmaster')
@section('title','NewJob')
<!--
Brady Berner & Pengyu Yin
CST-256
2-10-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

@section('content')

		<div class="alert alert-warning" role="alert" style="width:30%;">All fields are required!</div>
		<!-- form to capture user registration input and send it ot the propoer route to lead to the controller -->
		<form action="newJobHandler" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
			<div class="form-group">
				<label for="title">Title: </label>
				<input type="text" class="form-control" id="title" style="width:20%;" name="title"/><br>
				@if($errors->first('title') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('title')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="company">Company: </label>
				<input type="text" class="form-control" id="company" style="width:20%;" name="company"/><br>
				@if($errors->first('company') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('company')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="state">State: </label>
				<input type="text" class="form-control" id="state" style="width:20%;" name="state"/><br>
				@if($errors->first('state') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('state')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="city">City: </label>
				<input type="text" class="form-control" id="city" style="width:20%;" name="city"/><br>
				@if($errors->first('city') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('city')}}</div>
				@endif
			</div>
			<div class="form-group">
				<label for="description">Description: </label>
				<input type="text" class="form-control" id="description" style="width:20%;" name="description"/><br>
				@if($errors->first('description') != null)
					<div class="alert alert-danger" role="alert" style="width:20%;">{{$errors->first('description')}}</div>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Post</button>
		</form>
@endsection