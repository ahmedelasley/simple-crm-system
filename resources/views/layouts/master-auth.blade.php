<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<!-- Meta -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Simple CRM System Description">
		<meta name="Author" content="Engineer Ahmed Elasley">
		<meta name="Keywords" content="simple crm system, client, project, task">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Title -->
		<title>{{ config('app.name', 'Simple CRM System') }}</title>

		@include('layouts.head')

	</head>

	<body>

		@yield('content')
	
		@include('layouts.footer-scripts')	
	</body>
</html>