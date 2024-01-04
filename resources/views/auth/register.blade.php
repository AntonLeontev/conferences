@extends('layouts.auth')

@section('title', 'Регистрация')

@section('h1', 'Регистрация')

@section('content')
    <h2 class="registration__subtitle">Выберите формат регистрации:</h2>
    <div class="tabs" data-tabs="">
        <nav data-tabs-titles class="tabs__navigation">
            <button type="button" class="tabs__title _tab-active">Участник</button>
            <button type="button" class="tabs__title">Организация</button>
        </nav>
        <div data-tabs-body class="tabs__content">
            <div class="tabs__body">
                <div class="tabs__body-title">Участник</div>
                <form action="{{ route('register.participant') }}" method="POST" id="participant_form" class="registration__form form"
					@submit.prevent="submit"
					x-data="{
						form: $form('post', '{{ route('register.participant') }}', {
							email: '',
							password: '',
							password_confirmation: '',
							name_ru: '',
							surname_ru: '',
							middle_name_ru: '',
							name_en: '',
							surname_en: '',
							middle_name_en: '',
							phone: '',
						}),

						submit() {
							this.form.submit()
								.then(response => {
									location.replace('/')
								})
								.catch(error => {
									{{-- alert('An error occurred.'); --}}
								});
						},
					}"
				>
					@csrf
                    <div class="form__row">
                        <label class="form__label" for="u_1">E-mail (*)</label>
                        <input id="u_1" class="form-block__input input" autocomplete="off" type="email"
                            name="email" data-error="Ошибка" placeholder="E-mail"
							x-model="form.email"
							@input.debounce.1000ms="form.validate('email')"
						>
						<template x-if="form.invalid('email')">
							<div x-text="form.errors.email"></div>
						</template>
                    </div>
                    <div class="form__row">
                        <label class="form__label" for="u_2">Пароль (*)</label>
                        <div class="form-block">
                            <input id="u_2" class="form-block__input input" autocomplete="off" type="password"
                                name="password" data-error="Ошибка" placeholder="***"
								x-model="form.password"
								@input.debounce.1000ms="form.validate('password')"
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
						<template x-if="form.invalid('password')">
							<div x-text="form.errors.password"></div>
						</template>
                    </div>
                    <div class="form__row">
                        <label class="form__label" for="u_3">Повторить пароль (*)</label>
                        <div class="form-block">
                            <input id="u_3" class="form-block__input input" autocomplete="off" type="password"
                                name="password_confirmation" data-error="Ошибка" placeholder="***"
								x-model="form.password_confirmation"
								@input.debounce.1000ms="form.validate('password_confirmation')"
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
						<template x-if="form.invalid('password_confirmation')">
							<div x-text="form.errors.password_confirmation"></div>
						</template>
                    </div>
                    <div class="form__row _three">
                        <div class="form__line">
                            <label class="form__label" for="u_5">Имя (RU)</label>
                            <input id="u_5" class="input" autocomplete="off" type="text" name="name_ru"
                                data-error="Ошибка" placeholder="Имя" 
								x-model="form.name_ru"
								@input.debounce.1000ms="form.validate('name_ru')"
							>
                        </div>
                        <div class="form__line">
                            <label class="form__label" for="u_6">Фамилия (RU)</label>
                            <input id="u_6" class="input" autocomplete="off" type="text" name="surname_ru"
                                data-error="Ошибка" placeholder="Фамилия"
								x-model="form.surname_ru"
								@input.debounce.1000ms="form.validate('surname_ru')"
							>
                        </div>
                        <div class="form__line">
                            <label class="form__label" for="u_7">Отчество (RU)</label>
                            <input id="u_7" class="input" autocomplete="off" type="text" name="middle_name_ru"
                                data-error="Ошибка" placeholder="Отчество"
								x-model="form.middle_name_ru"
								@input.debounce.1000ms="form.validate('middle_name_ru')"
							>
                        </div>
                    </div>
					<template x-if="form.invalid('name_ru')">
						<div x-text="form.errors.name_ru"></div>
					</template>
					<template x-if="form.invalid('surname_ru')">
						<div x-text="form.errors.surname_ru"></div>
					</template>
					<template x-if="form.invalid('middle_name_ru')">
						<div x-text="form.errors.middle_name_ru"></div>
					</template>
                    <div class="form__row _three">
                        <div class="form__line">
                            <label class="form__label" for="u_8">First name (ENG)</label>
                            <input id="u_8" class="input" autocomplete="off" type="text" name="name_en"
                                data-error="Ошибка" placeholder="Name"
								x-model="form.name_en"
								@input.debounce.1000ms="form.validate('name_en')"
							>
                        </div>
                        <div class="form__line">
                            <label class="form__label" for="u_9">Surname (ENG)</label>
                            <input id="u_9" class="input" autocomplete="off" type="text" name="surname_en"
                                data-error="Ошибка" placeholder="Surname"
								x-model="form.surname_en"
								@input.debounce.1000ms="form.validate('surname_en')"
							>
                        </div>
                        <div class="form__line">
                            <label class="form__label" for="u_10">Middle name (ENG)</label>
                            <input id="u_10" class="input" autocomplete="off" type="text" name="middle_name_en"
                                data-error="Ошибка" placeholder="Name"
								x-model="form.middle_name_en"
								@input.debounce.1000ms="form.validate('middle_name_en')"
							>
                        </div>
                    </div>
					<template x-if="form.invalid('name_en')">
						<div x-text="form.errors.name_en"></div>
					</template>
					<template x-if="form.invalid('surname_en')">
						<div x-text="form.errors.surname_en"></div>
					</template>
					<template x-if="form.invalid('middle_name_en')">
						<div x-text="form.errors.middle_name_en"></div>
					</template>
                    <div class="form__row" x-data>
                        <label class="form__label" for="u_4">Телефон</label>
                        <input id="u_4" class="form-block__input input" autocomplete="off" type="text"
                            name="phone" data-error="Ошибка" placeholder="+7 (999) 999-99-99" x-mask="+7 (999) 999-99-99"
							x-model="form.phone"
							@input.debounce.1000ms="form.validate('phone')"
						>
						<template x-if="form.invalid('phone')">
							<div x-text="form.errors.phone"></div>
						</template>
                    </div>
                    <div class="form__row">
                        <button class="form__button button button_primary" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
            <div class="tabs__body">
                <div class="tabs__body-title">Организация</div>

				@if ($errors->any())
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
				@endif

                <form action="{{ route('register.organization') }}" method="POST" id="organization_form" class="registration__form form"
					@submit.prevent="submit"
					x-data="{
						form: $form('post', '{{ route('register.organization') }}', {
							email: '',
							password: '',
							password_confirmation: '',
							full_name: '',
							short_name: '',
							inn: '',
							address: '',
							phone: '',
							whatsapp: '',
							telegram: '',
							type: 'Университет',
							actions: [],
							logo: '',
							vk: '',
						}),
						actions: null,

						init() {
							this.handleActions()
						},
						submit() {
							this.form.submit()
								.then(response => {
									location.replace('/')
								})
								.catch(error => {
									{{-- alert('An error occurred.'); --}}
								});
						},
						handleActions() {
							let result = []
							this.actions = actions.querySelectorAll('[name=\'actions\']')
							this.actions.forEach(el => {
								if (el.checked) {
									result.push(el.value)
								}

								if (el.getAttribute('type') === 'text') {
									if (el.value.trim() === '') {
										result.pop()
									} else {
										result.push(el.value)
									}
								}
							})
							this.form.actions = result
							this.form.validate('actions')
						},
						logoChange() {
							const formImage = this.$refs.formImage
							const formPreview = this.$refs.formPreview
							const file = formImage.files[0]

							this.form.logo = file

							let reader = new FileReader();
							reader.onload = function (e) {
								formPreview.innerHTML = `<img src='${e.target.result}' alt='Фото'>`;
							};
							reader.onerror = function (e) {
								alert('Ошибка');
							};
							reader.readAsDataURL(file);
						},
					}"
				>
					@csrf
                    <div class="form__row">
                        <label class="form__label" for="o_1">E-mail (*)</label>
                        <input id="o_1" class="form-block__input input" autocomplete="off" type="email"
                            name="email" data-error="Ошибка" placeholder="E-mail"
							x-model="form.email"	
							@input.debounce.1000ms="form.validate('email')"
						>
						    <template x-if="form.invalid('email')">
								<div x-text="form.errors.email"></div>
							</template>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_2">Пароль (*)</label>
                        <div class="form-block">
                            <input id="o_2" class="form-block__input input" autocomplete="off" type="password"
                                name="password" data-error="Ошибка" placeholder="***"
								x-model="form.password"	
								@input.debounce.1000ms="form.validate('password')"	
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
						<template x-if="form.invalid('password')">
							<div x-text="form.errors.password"></div>
						</template>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_3">Повторить пароль (*)</label>
                        <div class="form-block">
                            <input id="o_3" class="form-block__input input" autocomplete="off" type="password"
                                name="password_confirmation" data-error="Ошибка" placeholder="***"
								x-model="form.password_confirmation"	
								@input.debounce.1000ms="form.validate('password_confirmation')"	
							>
                            <button class="form-block__btn btn__viewpass _icon-eye" type="button" tabindex="-1"></button>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_4">Название организации (*)</label>
                        <div class="form__line">
                            <input id="o_4" class="form__input input" autocomplete="off" type="text"
                                name="full_name" data-error="Ошибка" placeholder="Полное название"
								x-model="form.full_name"	
								@input.debounce.1000ms="form.validate('full_name')"	
							>
							<template x-if="form.invalid('full_name')">
								<div x-text="form.errors.full_name"></div>
							</template>
                        </div>
                        <div class="form__line">
                            <input class="form__input input" autocomplete="off" type="text" name="short_name"
                                data-error="Ошибка" placeholder="Сокращенное название"
								x-model="form.short_name"	
								@input.debounce.1000ms="form.validate('short_name')"	
							>
							<template x-if="form.invalid('short_name')">
								<div x-text="form.errors.short_name"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_5">Идентификационный номер
                            налогоплательщика</label>
                        <div class="form__line">
                            <input id="o_5" class="input" autocomplete="off" type="text" name="inn"
                                data-error="Ошибка" placeholder="ИНН"
								x-model="form.inn"	
								@input.debounce.1000ms="form.validate('inn')"	
							>
							<template x-if="form.invalid('inn')">
								<div x-text="form.errors.inn"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_6">Адрес (*)</label>
                        <textarea id="o_6" autocomplete="off" name="address" placeholder="Адрес" data-error="Ошибка"
                            class="input _smaller"
							x-model="form.address"	
							@input.debounce.1000ms="form.validate('address')"	
						></textarea>
						<template x-if="form.invalid('address')">
							<div x-text="form.errors.address"></div>
						</template>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_7">Телефон (*)</label>
                        <div class="form__line" x-data>
                            <input id="o_7" class="input" autocomplete="off" type="text" name="phone"
                                data-error="Ошибка" placeholder="Телефон" x-mask="+7 (999) 999-99-99"
								x-model="form.phone"	
								@input.debounce.1000ms="form.validate('phone')"	
							>
							<template x-if="form.invalid('phone')">
								<div x-text="form.errors.phone"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_8">Ссылка на WhatsApp контактного лица</label>
                        <div class="form__line">
                            <input id="o_8" class="input" autocomplete="off" type="text" name="whatsapp"
                                data-error="Ошибка" placeholder="https://wa.me/70001234567"
								x-model="form.whatsapp"	
								@input.debounce.1000ms="form.validate('whatsapp')"
							>
							<template x-if="form.invalid('whatsapp')">
								<div x-text="form.errors.whatsapp"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_8">Ссылка на Telegram контактного лица</label>
                        <div class="form__line">
                            <input id="o_8" class="input" autocomplete="off" type="text" name="telegram"
                                data-error="Ошибка" placeholder="https://t.me/login"
								x-model="form.telegram"	
								@input.debounce.1000ms="form.validate('telegram')"
							>
							<template x-if="form.invalid('telegram')">
								<div x-text="form.errors.telegram"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row" id="organization_type" x-data="{
						other: false,
						select() {
							let item = this.$event.detail.select.parentElement.querySelector('.select__content').innerText
							this.form.type = item
							if (item === 'Другое') {
								this.other = true
								this.form.type = ''
							} else {
								this.other = false
							}
						},
					}">
                        <label class="form__label" for="s_1">Тип организации (*)</label>
						<div class="form__line">
							<select id="s_1" name="type" data-scroll="500" data-class-modif="form" 
								@select-callback.camel.document="select"
							>
								<option value="Университет" selected>Университет</option>
								<option value="Институт">Институт</option>
								<option value="Научно-исследовательский институт">Научно-исследовательский институт</option>
								<option value="Некоммерческая организация">Некоммерческая организация</option>
								<option value="Коммерческая организация">Коммерческая организация</option>
								<option value="Другое">Другое</option>
							</select>
						</div>
						<div class="form__line" x-show="other" x-transition>
							<template x-if="other">
								<input class="input" autocomplete="off" type="text" name="type"
									data-error="Ошибка" placeholder="Введите тип организации"
									x-model="form.type"	
									@input.debounce.1000ms="form.validate('type')"
								>
							</template>
							<template x-if="form.invalid('type')">
								<div x-text="form.errors.type"></div>
							</template>	
						</div>
                    </div>

                    <div class="form__row _one" x-data="{other: false}" id="actions">
                        <label class="form__label" for="s_2">Деятельность (*)</label>

						<input type="checkbox" class="checkbox__input" name="actions" id="c_1" value="Наука" checked @change="handleActions">
						<label for="c_1" class="checkbox__label">
							<span class="checkbox__text">Наука</span>
						</label>

						<input type="checkbox" class="checkbox__input" name="actions" id="c_2" value="Образование" @change="handleActions">
						<label for="c_2" class="checkbox__label">
							<span class="checkbox__text">Образование</span>
						</label>

						<input type="checkbox" class="checkbox__input" name="actions" id="c_3" value="Коммерческая деятельность" 
							@change="handleActions">
						<label for="c_3" class="checkbox__label">
							<span class="checkbox__text">Коммерческая деятельность</span>
						</label>

						<input type="checkbox" class="checkbox__input" name="actions" id="c_4" value="Другое" x-model="other" @change="handleActions">
						<label for="c_4" class="checkbox__label">
							<span class="checkbox__text">Другое</span>
						</label>

						<div class="form__line" x-show="other" x-transition x-cloak>
							<template x-if="other">
								<input class="input" autocomplete="off" type="text" name="actions"
									data-error="Ошибка" placeholder="Введите тип деятельности"
									@change="handleActions"	
								>
							</template>
						</div>
						<template x-if="form.invalid('actions')">
							<div x-text="form.errors.actions"></div>
						</template>
                    </div>

                    <div class="form__row">
                        <div class="file" data-file>
                            <div class="file__item">
                                <div x-ref="formPreview" class="file__preview"></div>
                                <input x-ref="formImage" accept=".jpg, .png" type="file" name="logo"
                                    class="file__input" 
									@change="logoChange"
								>
								<template x-if="form.invalid('logo')">
									<div x-text="form.errors.logo"></div>
								</template>
                                <div class="file__button button">Добавить лого</div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="o_9">Вконтакте</label>
                        <div class="form__line">
                            <input id="o_9" class="input" autocomplete="off" type="text" name="vk"
                                data-error="Ошибка" placeholder="Ссылка на профиль вконтакте"
								x-model="form.vk"	
								@input.debounce.1000ms="form.validate('vk')"
							>
							<template x-if="form.invalid('vk')">
								<div x-text="form.errors.vk"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row">
                        <button class="form__button button button_primary" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
