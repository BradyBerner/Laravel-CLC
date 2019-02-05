@extends('layouts.appmaster')
@section('title','Login Results')

@section('content')
		@if($result)
			@if($status)
				<h3>You logged in successfully</h3>
			@else
				<div class="alert alert-danger" role="alert" style="width:20%;">Your account has been disabled please contact an administrator</div>
			@endif
		@else
			<h3>Invalid login credentials</h3><br>
			<a href="Login">Try Again</a>
		@endif
@endsection