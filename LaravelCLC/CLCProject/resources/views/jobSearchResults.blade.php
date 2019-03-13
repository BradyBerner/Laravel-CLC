@extends('layouts.appmaster')
@section('title','Search Results')

@section('imports')
    <link rel="stylesheet" href="resources/assets/css/Features-Boxed.css">
@endsection

@section('content')
	@if(count($jobs) != 0)
        <div class="features-boxed">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center text-white" style="height: 5px;">Search Results:</h2>
                </div>
                <div class="row justify-content-center features">
                	@foreach($jobs as $job)
                		<div class="col-sm-6 col-md-5 col-lg-4 item">
                			<div id="result" class="box">
                				<h3 class="text-white name">Company: {{$job['COMPANY']}}</h3>
                				<h3 class="text-white name">Job Title: {{$job['TITLE']}}</h3>
                				<p class="description">{{$job['DESCRIPTION']}}</p>
                				<a href="#" class="learn-more">Learn more »</a>
                			</div>
                		</div>
                	@endforeach
                </div>
            </div>
        </div>
    @else
   		<h2 class="text-center text-white">No Results Found</h2>
    @endif
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection