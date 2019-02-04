@extends('layouts.appmaster')
@section('title','Login Results')

@section('content')
<html>
	<body>
		@if($result)
			<h3>You logged in successfully</h3>
		@else
			<h3>Invalid login credentials</h3><br>
			<a href="Login">Try Again</a>
		@endif
	</body>
</html>
@endsection