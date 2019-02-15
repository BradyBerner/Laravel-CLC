@extends('layouts.appmaster')
@section('title','Error')

@section('content')
	<div class="alert alert-danger" role="alert">
		{{error_message}}
	</div>
@endsection