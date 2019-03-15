@extends('layouts.appmaster')
@section('title','Job Posting')


@section('content')
	<div class="card border-dark" style="width: 70%;margin: auto;margin-top: 20%;">
        <div class="card-header" style="background-color: rgb(59, 61, 63);">
            <h5 class="text-white mb-0">Heading</h5>
        </div>
        <div class="card-body" style="background-color: rgb(40, 40, 40);">
            <p class="text-white card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
            @if(Session::has('ID'))
            	<!-- There will be another if statement here allowing the user to apply to or get rid of their application to the job -->
            @else
            	<div class="alert alert-warning" style="width:40%;">Please login if you'd like to apply</div>
            @endif
        </div>
	</div>
@endsection