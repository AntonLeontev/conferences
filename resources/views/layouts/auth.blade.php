<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title') | CRC</title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/style.css', 'resources/js/app.js'])

    @yield('head_scripts')
	<style>
		[x-cloak] {display: none;}
	</style>
</head>

<body>
    <div class="wrapper">
        <main class="page page_registration">
            <section class="registration page-divider">
                <div class="registration__header _auth">
                    <a href="@yield('back_link', route('home'))" class="registration__btn">
                        <img src="{{ Vite::asset('resources/img/arrow-l.svg') }}" alt="Image">
                    </a>
                    <h1 class="registration__title title">@yield('h1')</h1>
                </div>
                <div class="registration__container">
					@yield('content')
                </div>
            </section>
        </main>
    </div>
    @yield('body_scripts')
</body>

</html>
