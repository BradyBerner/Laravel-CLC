<html lang="en">
	<head>
		<title>@yield('title')</title>
		<style>
            body{
                background-color: rgb(43, 43, 43) !important;
                color:white !important;
            }
		</style>
	</head>
	
	<body>
		@include('layouts.header')
		<div align="center">
			@yield('content')
		</div>
	</body>
</html>