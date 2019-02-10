<!--
Brady Berner & Pengyu Yin
CST-256
2-10-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

<!-- Checks to make sure the user is logged in -->
@include('layouts.loggedIn')
@extends('layouts.appmaster')
@section('title','Profile')

@section('style')
<style>
#card-item{
    background-color:rgb(60,63,65) !important;
}
</style>
@endsection

@section('content')
<!-- The card div holds the user's overall profile information -->
<div class="card" style="width: 18rem; float:left !important; margin-left:20px;" id="card-item">
  <!-- Currently empty image container will contain user image in the future if we implement profile pictures -->
  <img src="..." class="card-img-top" alt="...">
  <!-- Contains the user's first and last name as well as their profile description -->
  <div class="card-body">
    <h5 class="card-title">{{$user['FIRSTNAME']}} {{$user['LASTNAME']}}</h5>
    <p class="card-text">{{$info['DESCRIPTION']}}</p>
  </div>
  <!-- Contains all the rest of the user's pertenant information -->
  <ul class="list-group list-group-flush">
    <li id="card-item" class="list-group-item">Age: {{$info['AGE']}}<br>Gender: {{$info['GENDER']}}</li>
    <li id="card-item" class="list-group-item">Phone: {{$info['PHONE']}}<br>Email: {{$user['EMAIL']}}</li>
    <li id="card-item" class="list-group-item">{{$address['CITY']}}, {{$address['STATE']}}</li>
  </ul>
  <!-- If statement to ensure that only the profile's owner can click the button to be able to edit their profile -->
  @if(Session::get('ID') == $ID)
  <div class="card-body">
    <!-- Form to take the user to the edit profile page for their profile -->
  	<form action="editUserProfile" method="get" id="editProfile">
  		<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
  		<input type="hidden" name="ID" value="{{Session::get('ID')}}"/>
    	<button type="submit" class="btn btn-primary">Update Information</button>
    </form>
  </div>
  @endif
</div>
@endsection