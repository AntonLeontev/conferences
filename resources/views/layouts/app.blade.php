<!DOCTYPE html>
<html lang="ru">
<head>
	<title>@yield('title') | CRC</title>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	@vite(['resources/css/style.css', 'resources/js/app.js'])

	@yield('head_scripts')
</head>
<body>
	<div class="wrapper">
		@include('partials.header')

		@yield('content')

		@include('partials.footer')
	</div>
	@yield('body_scripts')
</body>
</html>
