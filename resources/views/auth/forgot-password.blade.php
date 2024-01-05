@extends('layouts.auth')

@section('title', 'Напомнить пароль')

@section('h1', 'Напомнить пароль')

@section('content')
	<form action="/forgot-password" method="POST" class="registration__form form">
		@csrf
        <h2 class="form__title">Введите email на который зарегистрирован аккаунт</h2>
        <div class="form__row">
            <label class="form__label" for="i_1">E-mail (*)</label>
            <input id="i_1" class="form-block__input input" autocomplete="off" type="email" name="email"
                data-error="Ошибка" placeholder="E-mail" value="{{ old('email') }}">
			@error('email')
				<div>{{ $message }}</div>
			@enderror
			@if (session('status'))
				<div class="">
					{{ session('status') }}
				</div>
			@endif
        </div>

        <div class="form__row">
            <button class="form__button button button_primary" type="submit">Отправить</button>
        </div>
    </form>
@endsection
