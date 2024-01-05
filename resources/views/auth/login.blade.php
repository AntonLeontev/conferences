@extends('layouts.auth')

@section('title', 'Вход')

@section('h1', 'Авторизация')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="registration__form form">
		@csrf
        <h2 class="form__title">Чтобы войти в систему, введите свой адрес электронной почты и пароль</h2>
        <div class="form__row">
            <label class="form__label" for="i_1">E-mail (*)</label>
            <input id="i_1" class="form-block__input input" autocomplete="off" type="email" name="email"
                data-error="Ошибка" placeholder="E-mail" value="{{ old('email') }}">
			@error('email')
				<div>{{ $message }}</div>
			@enderror
        </div>
        <div class="form__row">
            <label class="form__label" for="i_2">Пароль (*)</label>
            <input id="i_2" class="form-block__input input" autocomplete="off" type="password" name="password"
                data-error="Ошибка" placeholder="***">
			@error('password')
				<div>{{ $message }}</div>
			@enderror
        </div>

        <div class="form__row">
            <button class="form__button button button_primary" type="submit">Отправить</button>
        </div>

		<div class="form__row">
			<a href="{{ route('register') }}">Регистрация</a>
		</div>
		<div class="form__row">
			<a href="{{ route('password.request') }}">Забыли пароль?</a>
		</div>
    </form>
	@if (session('status'))
		<div class="mb-4 font-medium text-sm text-green-600">
			{{ session('status') }}
		</div>
	@endif
@endsection
