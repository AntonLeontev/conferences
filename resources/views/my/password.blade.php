@extends('layouts.app')

@section('title', 'Изменить пароль')

@section('content')
    <main class="page">
        <section class="event">
            <div class="event__container">
                <h1 class="event__title">Изменить пароль</h1>
                <form class="event__form form" @submit.prevent="submit" x-data="{
                    form: $form('post', '{{ route('my.password.update') }}', {
                        password: '',
                        new_password: '',
                        new_password_confirmation: '',
                    }),
                
                    submit() {
                        this.form.submit()
                            .then(response => {
                                location.replace(response.data.redirect ?? '/')
                            })
                            .catch(error => {});
                    },
                }">
                    <div class="form__row" :class="form.invalid('password') && '_error'">
                        <label class="form__label" for="u_2">Введите старый пароль (*)</label>
                        <div class="form-block">
                            <input id="u_2" class="form-block__input input" autocomplete="off" type="password"
                                name="password" data-error="Ошибка" placeholder="Старый пароль"
								x-model="form.password"
								@input.debounce.1000ms="form.validate('password')"
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
						<template x-if="form.invalid('password')">
							<div class="form__error" x-text="form.errors.password"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('new_password') && '_error'">
                        <label class="form__label" for="u_2">Новый пароль (*)</label>
                        <div class="form-block">
                            <input id="u_2" class="form-block__input input" autocomplete="off" type="password"
                                name="new_password" data-error="Ошибка" placeholder="Новый пароль"
								x-model="form.new_password"
								@input.debounce.1000ms="form.validate('new_password')"
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
						<template x-if="form.invalid('new_password')">
							<div class="form__error" x-text="form.errors.new_password"></div>
						</template>
                    </div>
                    <div class="form__row" :class="form.invalid('new_password_confirmation') && '_error'">
                        <label class="form__label" for="u_3">Повторите новый пароль (*)</label>
                        <div class="form-block">
                            <input id="u_3" class="form-block__input input" autocomplete="off" type="password"
                                name="new_password_confirmation" data-error="Ошибка" placeholder="Повторите новый пароль"
								x-model="form.new_password_confirmation"
								@input.debounce.1000ms="form.validate('password_confirmation')"
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
						<template x-if="form.invalid('new_password_confirmation')">
							<div class="form__error" x-text="form.errors.new_password_confirmation"></div>
						</template>
                    </div>

                    <div class="form__row">
                        <div class="form__btns">
                            <button class="form__button button button_primary" type="submit">Изменить</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
