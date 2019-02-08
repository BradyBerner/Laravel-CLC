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
<div class="card" style="width: 18rem; float:left !important; margin-left:20px;" id="card-item">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{$user['FIRSTNAME']}} {{$user['LASTNAME']}}</h5>
    <p class="card-text">{{$info['DESCRIPTION']}}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li id="card-item" class="list-group-item">Age: {{$info['AGE']}}<br>Gender: {{$info['GENDER']}}</li>
    <li id="card-item" class="list-group-item">Phone: {{$info['PHONE']}}<br>Email: {{$user['EMAIL']}}</li>
    <li id="card-item" class="list-group-item">{{$address['CITY']}}, {{$address['STATE']}}</li>
  </ul>
  @if(Session::get('ID') == $ID)
  <div class="card-body">
  	<form action="editUserProfile" method="post" id="editProfile">
  		<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
  		<input type="hidden" name="ID" value="{{Session::get('ID')}}"/>
    	<button type="submit" class="btn btn-primary">Update Information</button>
    </form>
  </div>
  @endif
</div>
@endsection