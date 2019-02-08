@extends('layouts.appmaster')
@section('title','Registration Result')

@section('content')
		@if($result)
		<h3>You Registered Successfully</h3><br>
		<a href="Login">Log In</a>
		@else
		<h3>Registration Failed</h3><br>
		<a href="Register">Try Again</a>
		@endif
@endsection