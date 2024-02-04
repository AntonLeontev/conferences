<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('partials.head')

	<title>@yield('title') | {{ config('app.name') }}</title>

	@yield('head_scripts')
	<script src="/js/scripts.js" defer></script>
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
