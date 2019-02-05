@include('layouts.admin')
@extends('layouts.appmaster')
@section('title','UserAdmin')

@section('imports')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="public/css/table.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
@endsection

@section('content')
<table id="users" class="table table-striped table-bordered" style="width:85%;">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Position</th>
			<th scope="col">Office</th>
			<th scope="col">Age</th>
			<th scope="col">Start date</th>
			<th scope="col">Salary</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tiger Nixon</td>
			<td>System Architect</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>2011/04/25</td>
			<td>$320,800</td>
		</tr>
		<tr>
			<td>Garrett Winters</td>
			<td>Accountant</td>
			<td>Tokyo</td>
			<td>63</td>
			<td>2011/07/25</td>
			<td>$170,750</td>
		</tr>
	</tbody>
</table>

<script>
	$(document).ready( function () {
  		$('#users').DataTable();
	} );
</script>
@endsection