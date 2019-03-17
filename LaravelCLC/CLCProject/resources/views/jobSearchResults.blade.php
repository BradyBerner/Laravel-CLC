@extends('layouts.appmaster')
@section('title','Search Results')

<!--
Brady Berner & Pengyu Yin
CST-256
3-17-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

@section('imports')
    <link rel="stylesheet" href="resources/assets/css/Features-Boxed.css">
@endsection

@section('content')
	@if(count($jobs) != 0)
		@if(count($jobs) > 9)
			<div class="alert alert-danger" style="width:40%;">There were too many results here are some of them.<br>Consider searching with more specific terms</div><br>
		@endif
        <div class="features-boxed">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center text-white" style="height: 5px;">Search Results:</h2>
                </div>
                <div class="row justify-content-center features">
                	@if(count($jobs) <= 9)
                    	@foreach($jobs as $job)
                    		<div class="col-sm-6 col-md-5 col-lg-4 item">
                    			<div id="result" class="box">
                    				<h3 class="text-white name">Company: {{$job['COMPANY']}}</h3>
                    				<h3 class="text-white name">Job Title: {{$job['TITLE']}}</h3>
                    				<p class="description">{{$job['DESCRIPTION']}}</p>
                    				<form action="viewJob" method="post">
                    					<input type="hidden" name="_token" value="{{csrf_token()}}">
                    					<input type="hidden" name="jobID" value="{{$job['IDJOBS']}}">
                    					<button type="submit" class="btn btn-primary">Learn more »</button>
                    				</form>
                    			</div>
                    		</div>
                    	@endforeach
                    @else
                    	@for($i = 0; $i < 9; $i++)
                    		<div class="col-sm-6 col-md-5 col-lg-4 item">
                    			<div id="result" class="box">
                    				<h3 class="text-white name">Company: {{$jobs[$i]['COMPANY']}}</h3>
                    				<h3 class="text-white name">Job Title: {{$jobs[$i]['TITLE']}}</h3>
                    				<p class="description">{{$jobs[$i]['DESCRIPTION']}}</p>
                    				<form action="viewJob" method="post">
                    					<input type="hidden" name="_token" value="{{csrf_token()}}">
                    					<input type="hidden" name="jobID" value="{{$jobs[$i]['IDJOBS']}}">
                    					<button type="submit" class="btn btn-primary">Learn more »</button>
                    				</form>
                    			</div>
                    		</div>
                    	@endfor
                    @endif
                </div>
            </div>
        </div>
    @else
   		<h2 class="text-center text-white">No Results Found</h2>
    @endif
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection