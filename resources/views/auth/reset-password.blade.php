@extends('layouts.auth')

@section('title', 'Сброс пароля')

@section('h1', 'Сброс пароля')

@section('content')
	<form action="/reset-password" method="POST" class="registration__form form">
		@csrf
        <h2 class="form__title">Введите новый пароль</h2>
        {{-- <div class="form__row">
            <label class="form__label" for="i_1">E-mail (*)</label>
            <input id="i_1" class="form-block__input input" autocomplete="off" type="email" name="email"
                data-error="Ошибка" placeholder="E-mail" value="{{ old('email') }}">
			@error('email')
				<div>{{ $message }}</div>
			@enderror
        </div> --}}
		<input type="hidden" name="email" value="{{ $request->email }}">
		<input type="hidden" name="token" value="{{ request()->route('token') }}">
		<div class="form__row">
			<label class="form__label" for="u_2">Пароль (*)</label>
			<div class="form-block">
				<input id="u_2" class="form-block__input input" autocomplete="off" type="password"
					name="password" data-error="Ошибка" placeholder="***"
				>
				<button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
			</div>
		</div>
		<div class="form__row">
			<label class="form__label" for="u_3">Повторить пароль (*)</label>
			<div class="form-block">
				<input id="u_3" class="form-block__input input" autocomplete="off" type="password"
					name="password_confirmation" data-error="Ошибка" placeholder="***"
				>
				<button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
			</div>
		</div>

        <div class="form__row">
            <button class="form__button button button_primary" type="submit">Отправить</button>
        </div>
    </form>
@endsection
