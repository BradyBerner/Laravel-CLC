@extends('layouts.appmaster')
@section('title','Login Results')

@section('content')
		@if($result)
			@if($status)
				<h3 class="alert alert-success" role="alert" style="width:20%;">You logged in successfully</h3>
			@else
				<?php Session::flush()?>
				<div class="alert alert-danger" role="alert" style="width:20%;">Your account has been disabled please contact an administrator</div>
			@endif
		@else
			<h3 class="alert alert-danger" role="alert" style="width:20%;">Invalid login credentials</h3><br>
			<a href="Login">Try Again</a>
		@endif
@endsection