<!--
Brady Berner & Pengyu Yin
CST-256
2-10-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->

@extends('layouts.appmaster')
@section('title','Login Results')

@section('content')
		<!-- Checks to see the result of the attempted log in -->
		@if($result)
			<!-- Checks to see that the user's account has not been suspended -->
			@if($status)
				<h3 class="alert alert-success" role="alert" style="width:20%;">You logged in successfully</h3>
			@else
				<!-- If the user's account has been suspended flushes the session and gives a message to the user -->
				<?php Session::flush()?>
				<div class="alert alert-danger" role="alert" style="width:20%;">Your account has been disabled please contact an administrator</div>
			@endif
		@else
			<!-- Lets the user know that they entered invalid login credentials -->
			<h3 class="alert alert-danger" role="alert" style="width:20%;">Invalid login credentials</h3><br>
			<a href="Login">Try Again</a>
		@endif
@endsection