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
    <h5 class="card-title">{{Session::get('NAME')['FIRSTNAME']}} {{Session::get('NAME')['LASTNAME']}}</h5>
    <p class="card-text">User description.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li id="card-item" class="list-group-item">Cras justo odio</li>
    <li id="card-item" class="list-group-item">Dapibus ac facilisis in</li>
    <li id="card-item" class="list-group-item">Vestibulum at eros</li>
  </ul>
  <div class="card-body">
  	<form action="editUserProfile" method="get" id="editProfile">
  		<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
  		<input type="hidden" name="ID" value="{{Session::get('ID')}}"/>
    	<button type="submit" class="btn btn-primary">Update Information</button>
    </form>
  </div>
</div>
@endsection