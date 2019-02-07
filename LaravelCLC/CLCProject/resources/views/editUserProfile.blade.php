@include('layouts.loggedIn')
@extends('layouts.appmaster')
@section('title','Edit Information')

@section('style')
<style>
    #darkerStyle{
        background-color:rgb(43, 43, 43) !important;
    }
    #darkStyle{
        background-color:rgb(60, 63, 65) !important;
    }
    input{
        width:70% !important;
    }
</style>
@endsection

@section('content')
<div class="card" style="width:60%;">
  <div class="card-header" id="darkStyle"> 
    <ul class="nav nav-tabs card-header-tabs pull-right"  id="myTab" role="tablist">
      <li class="nav-item" id="darkerStyle" style="border-top-left-radius:5px; border-top-right-radius:5px;">
       <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile Info</a>
      </li>
      <li class="nav-item" id="darkerStyle" style="border-top-left-radius:5px; border-top-right-radius:5px;">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Address</a>
      </li>
    </ul>
  </div>
  <div class="card-body" id="darkStyle">
   <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    	<form action="#" method="post">
    		<input type="hidden" name="_token" value="{{csrf_token()}}">
    		<input type="hidden" name="userID" value="{{Session::get('ID')}}">
    		<div class="form-group">
    			<label for="phone">Phone: </label>
    			<input type="text" class="form-control" id="phone" name="phone" value=""/>
    		</div>
    		<div class="form-group">
    			<label for="age">Age: </label>
    			<input type="text" class="form-control" id="age" name="age"/>
    		</div>
    		<div class="form-group">
    			<label for="gender">Gender: </label>
    			<input type="text" class="form-control" id="gender" name="gender"/>
    		</div>
    		<div class="form-group">
				<label for="description">Description: </label>
				<textarea class="form-control" id="description" name="description" rows="5"  style="width:70%;"></textarea>
			</div>
    		<button type="submit" class="btn btn-primary">Update</button>
    	</form>
    </div>
 	 <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		<form action="#" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
			<input type="hidden" name="userID" value="{{Session::get('ID')}}">
			<div class="form-group">
				<label for="street">Street Address: </label>
				<input type="text" class="form-control" id="street" name="street"/>
			</div>
			<div class="form-group">
				<label for="city">City: </label>
				<input type="text" class="form-control" id="city" name="city"/>
			</div>
			<div class="form-group">
				<label for="state">State: </label>
				<input type="text" class="form-control" id="state" name="state"/>
			</div>
			<div class="form-group">
				<label for="zip">Zip Code: </label>
				<input type="text" class="form-control" id="zip" name="zip"/>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
		</form>
 	 </div>
    </div>
  </div>
</div>
@endsection