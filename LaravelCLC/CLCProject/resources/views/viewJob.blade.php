@extends('layouts.appmaster')
@section('title','Job Posting')

<!--
Brady Berner & Pengyu Yin
CST-256
3-17-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

@section('content')
	<div class="card border-dark" style="width: 70%;margin: auto;margin-top: 20%;">
        <div class="card-header" style="background-color: rgb(59, 61, 63);">
            <h5 class="text-white mb-0">{{$job['TITLE']}}</h5>
        </div>
        <div class="card-body" style="background-color: rgb(40, 40, 40);">
            <p>
            	Company: {{$job['COMPANY']}}<br>
            	Location: {{$job['CITY']}}, {{$job['STATE']}}<br>
            	Description: {{$job['DESCRIPTION']}}
            </p>
            @if(Session::has('ID'))
            	@if(!$applied)
            		<form action="jobApply" method="post">
            			<input type="hidden" name="_token" value="{{csrf_token()}}">
            			<input type="hidden" name="jobID" value="{{$job['IDJOBS']}}">
            			<input type="hidden" name="userID" value="{{Session::get('ID')}}">
            			<button type="submit" class="btn btn-primary">Apply</button>
            		</form>
            	@else
            		<form action="jobCancel" method="post">
            			<input type="hidden" name="_token" value="{{csrf_token()}}">
            			<input type="hidden" name="jobID" value="{{$job['IDJOBS']}}">
            			<input type="hidden" name="userID" value="{{Session::get('ID')}}">
            			<button type="submit" class="btn btn-primary">Cancel Application</button>
            		</form>
            	@endif
            @else
            	<div class="alert alert-warning" style="width:40%;">Please login if you'd like to apply</div>
            @endif
        </div>
	</div>
@endsection