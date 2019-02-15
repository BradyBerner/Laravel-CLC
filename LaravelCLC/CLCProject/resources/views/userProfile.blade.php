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
#card-item {
	background-color: rgb(60, 63, 65) !important;
}

#darkerStyle {
	background-color: rgb(43, 43, 43) !important;
}

#darkStyle {
	background-color: rgb(60, 63, 65) !important;
}

input {
	width: 70% !important;
}
</style>
@endsection 

@section('content') 

@if($errors->count() != 0) 
	@if(Session::has('modal'))
	<script>
		$(document).ready(function(){
			$('#{{Session::get('modal')}}').modal('show')
		});
	</script>
	@endif
@endif

<!-- The card div holds the user's overall profile information -->
<div class="card" style="width: 18rem; float: left !important; margin-left: 20px;" id="card-item">
	<!-- Currently empty image container will contain user image in the future if we implement profile pictures -->
	<img src="..." class="card-img-top" alt="...">
	<!-- Contains the user's first and last name as well as their profile description -->
	<div class="card-body">
		<h5 class="card-title">{{$user['FIRSTNAME']}} {{$user['LASTNAME']}}</h5>
		<p class="card-text">{{$info['DESCRIPTION']}}</p>
	</div>
	<!-- Contains all the rest of the user's pertenant information -->
	<ul class="list-group list-group-flush">
		<li id="card-item" class="list-group-item">Age: {{$info['AGE']}}<br>Gender: {{$info['GENDER']}}
		</li>
		<li id="card-item" class="list-group-item">Phone: {{$info['PHONE']}}<br>Email: {{$user['EMAIL']}}
		</li>
		<li id="card-item" class="list-group-item">{{$address['CITY']}}, {{$address['STATE']}}</li>
	</ul>
	<!-- If statement to ensure that only the profile's owner can click the button to be able to edit their profile -->
	@if(Session::get('ID') == $ID)
	<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" id="darkerStyle">
					<h5 class="modal-title" id="ModalLabel">Update Your Profile Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.6;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="darkerStyle">
					@if($errors->count() != 0)
						@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert" style="width:50%;">{{$error}}</div><br>
						@endforeach
					@endif
					<div class="card">
						<div class="card-header" id="darkStyle">
							<ul class="nav nav-tabs card-header-tabs pull-right" id="myTab" role="tablist">
								<li class="nav-item" id="darkerStyle" style="border-top-left-radius: 5px; border-top-right-radius: 5px;"><a class="nav-link active"
									id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile Info</a></li>
								<li class="nav-item" id="darkerStyle" style="border-top-left-radius: 5px; border-top-right-radius: 5px;"><a class="nav-link"
									id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Address</a></li>
							</ul>
						</div>
						<div class="card-body" id="darkStyle">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<!-- Form for editing the user's userInfo -->
									<form action="editUserInfo" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}"> 
										<input type="hidden" name="userID" value="{{Request::get('ID')}}">
										<input type="hidden" name="modalName" value="editProfileModal"/>
										<div class="form-group">
											<label for="phone">Phone: </label> <input type="text" class="form-control" id="phone" name="phone"
												value="@if($info['PHONE'] != null){{$info['PHONE']}}@endif" />
										</div>
										<div class="form-group">
											<label for="age">Age: </label> <input type="text" class="form-control" id="age" name="age"
												value="@if($info['AGE'] != null){{$info['AGE']}}@endif" />
										</div>
										<div class="form-group">
											<label for="gender">Gender: </label> <input type="text" class="form-control" id="gender" name="gender"
												value="@if($info['GENDER'] != null){{$info['GENDER']}}@endif" />
										</div>
										<div class="form-group">
											<label for="description">Description: </label>
											<textarea class="form-control" id="description" name="description" rows="5" style="width: 70%;">@if($info['DESCRIPTION'] != null){{$info['DESCRIPTION']}}@endif</textarea>
										</div>
										<button type="submit" class="btn btn-primary">Update</button>
									</form>
								</div>
								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<!-- Form for editing the user's address information -->
									<form action="editUserAddress" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}" /> 
										<input type="hidden" name="userID" value="{{Session::get('ID')}}">
										<input type="hidden" name="modalName" value="editProfileModal"/>
										<div class="form-group">
											<label for="street">Street Address: </label> <input type="text" class="form-control" id="street" name="street"
												value="@if($address['STREET'] != null){{$address['STREET']}}@endif" />
										</div>
										<div class="form-group">
											<label for="city">City: </label> <input type="text" class="form-control" id="city" name="city"
												value="@if($address['CITY'] != null){{$address['CITY']}}@endif" />
										</div>
										<div class="form-group">
											<label for="state">State: </label> <input type="text" class="form-control" id="state" name="state"
												value="@if($address['STATE'] != null){{$address['STATE']}}@endif" />
										</div>
										<div class="form-group">
											<label for="zip">Zip Code: </label> <input type="text" class="form-control" id="zip" name="zip"
												value="@if($address['ZIP'] != null){{$address['ZIP']}}@endif" />
										</div>
										<button type="submit" class="btn btn-primary">Update</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<button type="button" class="btn btn-primary" data-toggle="modal" href="#editProfileModal">Update Profile</button>
	</div>
	@endif
</div>

<div class="card" style="width:73%; float: left !important; margin-left: 20px;">
	<div class="card-header" id="darkStyle">
		<ul class="nav nav-tabs card-header-tabs pull-right" id="myTab" role="tablist">
			<li class="nav-item" id="darkerStyle" style="border-top-left-radius: 5px; border-top-right-radius: 5px;"><a class="nav-link active"
				id="home-tab" data-toggle="tab" href="#education" role="tab" aria-controls="home" aria-selected="true">Education</a></li>
			<li class="nav-item" id="darkerStyle" style="border-top-left-radius: 5px; border-top-right-radius: 5px;"><a class="nav-link" id="profile-tab"
				data-toggle="tab" href="#workExperience" role="tab" aria-controls="profile" aria-selected="false">Work Experience</a></li>
		</ul>
	</div>
	<div class="card-body" id="darkStyle">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="education" role="tabpanel" aria-labelledby="home-tab">
				<!-- Education -->
				<div class="card-deck">
					<div class="card" id="darkerStyle" style="width:20px !important;">
						<div class="card-body">
							<h3 class="card-title">Example School Name</h3>
						</div>
						<ul class="list-group list-group-flush">
							<li id="card-item" class="list-group-item">Education Focus</li>
							<li id="card-item" class="list-group-item">Years Attended</li>
						</ul>
					</div>
				</div>
				<!-- Button to add education card -->
				<button class="btn btn-primary">Add Education Card</button>
			</div>
			<div class="tab-pane fade" id="workExperience" role="tabpanel" aria-labelledby="profile-tab">
				<!-- Work Experience -->
				Work Experience Placeholder
			</div>
		</div>
	</div>
</div>
@endsection
