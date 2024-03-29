@extends('layouts.app')

@section('title', __('my/events/create.title'))

@section('content')
    <main class="page">
        <section class="event">
            <div class="event__container">
                <h1 class="event__title">Создать мероприятие</h1>
                <form action="#" class="event__form form" 
					@select-callback.camel.document="select"
					@submit.prevent="submit"
					x-data="{
						form: $form('post', '{{ route('conference.store') }}', {
							title_ru: '',
							title_en: '',
							slug: '',
							conference_type_id: '',
							format: '',
							with_foreign_participation: false,
							subjects: [],
							sections: {},
							logo: '',
							website: '',
							need_site: false,
							'co-organizers': {},
							address: '',
							phone: '',
							email: '',
							start_date: '',
							end_date: '',
							description_ru: '',
							description_en: '',
							lang: '',
							participants_number: '',
							report_form: '',
							whatsapp: '',
							telegram: '',
							price_participants: '',
							price_visitors: '',
							discount_students: {amount: 0, unit: 'RUB'},
							discount_participants: {amount: 0, unit: 'RUB'},
							discount_special_guest: {amount: 0, unit: 'RUB'},
							discount_young_scientist: {amount: 0, unit: 'RUB'},
							abstracts_price: '',
							abstracts_format: '',
							abstracts_lang: '',
							max_thesis_characters: 2500,
							thesis_accept_until: '',
							thesis_edit_until: '',
							thesis_instruction: '',
						}),
						formatCheckShow: true,
						formDisabled: false,

						init() {
							document.querySelectorAll('select')
								.forEach(select => this.getSelectValue(select))
						},
						select() {
							let select = this.$event.detail.select
							this.getSelectValue(select)
						},
						getSelectValue(select) {
							if (select.dataset.name == 'subjects') {
								this.form.subjects = Array.from(select.querySelectorAll('option:checked'), e => +e.value)
							} else if (select.dataset.name == 'conference_type_id') {
								this.form.conference_type_id = select.value
							} else if (select.dataset.name == 'format') {
								this.form.format = select.value
								if (select.value == 'national') this.formatCheckShow = true
								else this.formatCheckShow = false
							} else if (select.dataset.name == 'lang') {
								this.form.lang = select.value
							} else if (select.dataset.name == 'participants_number') {
								this.form.participants_number = select.value
							} else if (select.dataset.name == 'report_form') {
								this.form.report_form = select.value
							} else if (select.dataset.name == 'abstracts_format') {
								this.form.abstracts_format = select.value
							} else if (select.dataset.name == 'abstracts_lang') {
								this.form.abstracts_lang = select.value
							} else if (select.dataset.name == 'discount_students_unit') {
								this.form.discount_students.unit = select.value
								this.form.validate('discount_students')
							} else if (select.dataset.name == 'discount_participants_unit') {
								this.form.discount_participants.unit = select.value
								this.form.validate('discount_participants')
							} else if (select.dataset.name == 'discount_special_guest_unit') {
								this.form.discount_special_guest.unit = select.value
								this.form.validate('discount_special_guest')
							} else if (select.dataset.name == 'discount_young_scientist_unit') {
								this.form.discount_young_scientist.unit = select.value
								this.form.validate('discount_young_scientist')
							}
						},
						submit() {
							this.formDisabled = true

							this.form.submit()
								.then(response => {
									location.replace('/events/' + response.data.slug)
									this.formDisabled = false
								})
								.catch(error => {
									this.formDisabled = false
								})
						},
					}"
				>
                    <div class="form__row" :class="form.invalid('title_ru') && '_error'">
                        <label class="form__label" for="c_1">Название мероприятия RU (*)</label>
                        <input id="c_1" class="input" autocomplete="off" type="text" name="title_ru"
                            placeholder="Название мероприятия"
							x-model="form.title_ru"	
							@input.debounce.1000ms="form.validate('title_ru')"
						>
						<template x-if="form.invalid('title_ru')">
							<div class="form__error" x-text="form.errors.title_ru"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('title_en') && '_error'">
                        <label class="form__label" for="c_2">Название мероприятия ENG (*)</label>
                        <input id="c_2" class="input" autocomplete="off" type="text" name="title_en"
                            placeholder="Event name"
							x-model="form.title_en"	
							@input.debounce.1000ms="form.validate('title_en')"
						>
						<template x-if="form.invalid('title_en')">
							<div class="form__error" x-text="form.errors.title_en"></div>
						</template>
                    </div>

					<div class="form__row" :class="form.invalid('slug') && '_error'">
						<label class="form__label" for="a_1">Укажите акроним меропрития (*)</label>
						<input class="input" id="a_1" autocomplete="off" type="text" name="slug" 
							placeholder="Текст для генерации ссылки мероприятия. Например: geocosmos-{{ now()->format('Y') }}"
							x-model="form.slug"	
							@input.debounce.1000ms="form.validate('slug')"
						>
						<template x-if="form.invalid('slug')">
							<div class="form__error" x-text="form.errors.slug"></div>
						</template>
						<div class="form__link" x-text="location.origin + '/events/' + form.slug"></div>
					</div>

                    <div class="form__row" :class="form.invalid('conference_type_id') && '_error'">
                        <label class="form__label">Тип мероприятия (*)</label>
                        <select name="type" data-scroll="500" data-class-modif="form" data-name="conference_type_id">
							@foreach (conference_types() as $type)
                            	<option	value="{{ $type->id }}">{{ $type->{'title_'.loc()} }}</option>
							@endforeach
                        </select>
						<template x-if="form.invalid('conference_type_id')">
							<div class="form__error" x-text="form.errors.conference_type_id"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('format') && '_error'">
                        <label class="form__label">Формат мероприятия (*)</label>
                        <select name="format" data-scroll="500" data-class-modif="format" data-name="format">
                            <option value="national" selected>Российское / национальное</option>
                            <option value="international">Международное</option>
                        </select>
						<template x-if="form.invalid('format')">
							<div class="form__error" x-text="form.errors.format"></div>
						</template>
                        <div class="checkbox" x-show="formatCheckShow" x-transition>
                            <input id="chx_1" class="checkbox__input" type="checkbox" value="1"
                                name="with_foreign_participation" x-model="form.with_foreign_participation">
                            <label for="chx_1" class="checkbox__label">
                                <span class="checkbox__text">С международным участием</span>
                            </label>
                        </div>
                    </div>

                    <div class="form__row" :class="form.invalid('subjects') && '_error'">
                        <label class="form__label">Тематика мероприятия (*)</label>
                        <select name="form[]" data-scroll="500" multiple data-class-modif="format" data-name="subjects">
                            @foreach (subjects() as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->{'title_' . app()->getLocale()} }}</option>
                            @endforeach
                        </select>
						<template x-if="form.invalid('subjects')">
							<div class="form__error" x-text="form.errors.subjects"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('sections') && '_error'" id="sections" 
						x-data="{
							ai: 1,

							add() {
								if (Object.keys(this.form.sections).length >= 5) return
								this.form.sections[this.ai] = {
									title_ru: '', 
									title_en: '', 
									slug: '', 
								}
								this.ai++
							},
							remove(id) {
								delete this.form.sections[id]
							},
						}"
					>
                        <label class="form__label">Список секций</label>
						<template x-for="section, id in form.sections" x-key="id">
							<div class="form-list">
								<label class="form-list__label">Название секции</label>
								<div :class="form.invalid(`sections.${id}.slug`) && '_error'">
									<input class="input" autocomplete="off" type="text" name="slug"
										placeholder="Акроним" x-model="form.sections[id].slug"
										@change="form.validate(`sections.${id}.slug`)">
									<template x-if="form.invalid(`sections.${id}.slug`)">
										<div class="form__error" x-text="form.errors[`sections.${id}.slug`]"></div>
									</template>
								</div>
								<div :class="form.invalid(`sections.${id}.title_ru`) && '_error'">
									<input class="input" autocomplete="off" type="text" name="title_ru"
										placeholder="Название секции (RU)" 
										x-model="form.sections[id].title_ru" 
										@change="form.validate(`sections.${id}.title_ru`)"
									>
									<template x-if="form.invalid(`sections.${id}.title_ru`)">
										<div class="form__error" x-text="form.errors[`sections.${id}.title_ru`]"></div>
									</template>
								</div>
								<div :class="form.invalid(`sections.${id}.title_en`) && '_error'">
									<input class="input" autocomplete="off" type="text" name="title_en"
										placeholder="Название секции (EN)" 
										x-model="form.sections[id].title_en"
										@change="form.validate(`sections.${id}.title_en`)"
									>
									<template x-if="form.invalid(`sections.${id}.title_en`)">
										<div class="form__error" x-text="form.errors[`sections.${id}.title_en`]"></div>
									</template>
								</div>
								<button class="button button_outline" type="button" @click="remove(id)">Убрать секцию</button>
							</div>
						</template>
                        <button class="button" type="button" @click="add()">Добавить секцию</button>
                    </div>

                    {{-- <div class="form__row">
                        <label class="form__label" for="formImage">Загрузите ваш файл</label>
                        <div class="file" data-file>
                            <div class="file__item">
                                <div id="formPreview" class="file__preview"></div>
                                <input id="formImage" accept=".jpg, .png, .gif" type="file" name="image"
                                    class="file__input">
                                <div class="file__btns">
                                    <div class="file__button button">Добавить лого</div>
                                    <button class="button button_outline" type="button">Убрать логотип</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form__row" :class="form.invalid('website') && '_error'">
                        <label class="form__label" for="c_5">Сайт мероприятия</label>
                        <div class="d-grid">
                            <input id="c_5" class="input" autocomplete="off" type="text" name="website"
                                placeholder="http://website.com" 
								x-model="form.website"
								@input.debounce.1000ms="form.validate('website')"
							>
                            <div class="checkbox">
                                <input id="chx_2" class="checkbox__input" type="checkbox"
                                    value="1" name="need_site" x-model="form.need_site">
                                <label for="chx_2" class="checkbox__label">
                                    <span class="checkbox__text">Мне нужен сайт для мероприятия</span>
                                </label>
                            </div>
                        </div>
						<template x-if="form.invalid('website')">
							<div class="form__error" x-text="form.errors.website"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('co-organizers') && '_error'" id="co-organizers"
						x-data="{
							ai: 1,
							add() {
								this.form['co-organizers'][this.ai] = ''
								this.ai++
							},
							remove(id) {
								delete this.form['co-organizers'][id]
							},
						}"
					>
                        <div class="form__line">
                            <label class="form__label" for="c_6">Соорганизаторы мероприятия</label>
                        </div>
                        <div class="form__line">
							<template x-for="organizer, id in form['co-organizers']">
								<div class="form-list" :class="form.invalid(`co-organizers.${id}`) && '_error'">
									<input class="input" autocomplete="off" type="text" name="form[]"
										data-error="Ошибка" placeholder="Название организации" 
										x-model="form['co-organizers'][id]"
										@change="form.validate(`co-organizers.${id}`)"
									>
									<template x-if="form.invalid(`co-organizers.${id}`)">
										<div class="form__error" x-text="form.errors[`co-organizers.${id}`]"></div>
									</template>
									<button class="button button_outline" type="button" @click="remove(id)">Убрать соорганизатора</button>
								</div>
							</template>
                            <button class="button" type="button" @click="add">Добавить соорганизатора</button>
                        </div>

                    </div>

                    <div class="form__row" :class="form.invalid('address') && '_error'" id="address" x-data="{
						suggestions: [],
						show: false,
					}">
                        <label class="form__label" for="c_7">Адрес проведения мероприятия (*) </label>
                        <input id="c_7" class="input" autocomplete="off" type="text" name="form[]"
                            placeholder="Полный адрес"
							x-model="form.address"
							@input.debounce.1000ms="form.validate('address')"	
						>
                        <div class="input-tips" style="display: none" x-show="show" x-transition>
                            <ul>
                                <li>Санкт-Петербург, ул. Попова, д.5 </li>
                            </ul>
                        </div>
						<template x-if="form.invalid('address')">
							<div class="form__error" x-text="form.errors.address"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('phone') && '_error'">
                        <label class="form__label" for="c_8">Контактный телефон службы поддержки мероприятия </label>
                        <input id="c_8" class="input" autocomplete="off" type="text" name="form[]"
                            placeholder="Телефон"
							x-model="form.phone"
							@input.debounce.1000ms="form.validate('phone')"	
						>
						<template x-if="form.invalid('phone')">
							<div class="form__error" x-text="form.errors.phone"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('email') && '_error'">
                        <label class="form__label" for="c_9">Электронная почта службы поддержки мероприятия (*)</label>
                        <input id="c_9" class="input" autocomplete="off" type="text" name="form[]"
                            placeholder="mail@mail.ru"
							x-model="form.email"
							@input.debounce.1000ms="form.validate('email')"
						>
						<template x-if="form.invalid('email')">
							<div class="form__error" x-text="form.errors.email"></div>
						</template>
                    </div>

                    <div class="form__row _two">
                        <div class="form__line" :class="form.invalid('start_date') && '_error'">
                            <label class="form__label" for="date-start">Дата начала мероприятия (*)</label>
                            <input id="date-start" class="input" autocomplete="off" type="date" name="form[]"
                                placeholder="__.__.____"
								x-model="form.start_date"
								@change="form.validate('start_date')"
							>
                            <template x-if="form.invalid('start_date')">
								<div class="form__error" x-text="form.errors.start_date"></div>
							</template>
                        </div>
                        <div class="form__line" :class="form.invalid('end_date') && '_error'">
                            <label class="form__label" for="date-start">Дата окончания мероприятия (*)</label>
                            <input id="date-end" class="input" autocomplete="off" type="date"
                                placeholder="__.__.____"
								x-model="form.end_date"
								@change="form.validate('end_date')"
							>
							<template x-if="form.invalid('end_date')">
								<div class="form__error" x-text="form.errors.end_date"></div>
							</template>
                        </div>
                    </div>

                    <div class="form__row" :class="form.invalid('description_ru') && '_error'">
                        <label class="form__label" for="t_1">Описание мероприятия RU (*)</label>
                        <textarea id="t_1" autocomplete="off" name="description_ru" placeholder="Описание"
                            class="input _small"
							x-model="form.description_ru"
							@change="form.validate('description_ru')"
						></textarea>
						<template x-if="form.invalid('description_ru')">
							<div class="form__error" x-text="form.errors.description_ru"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('description_en') && '_error'">
                        <label class="form__label" for="t_1">Описание мероприятия ENG (*)</label>
                        <textarea id="t_1" autocomplete="off" name="description_en" placeholder="Описание"
                            class="input _small"
							x-model="form.description_en"
							@change="form.validate('description_en')"
						></textarea>
						<template x-if="form.invalid('description_en')">
							<div class="form__error" x-text="form.errors.description_en"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('lang') && '_error'">
                        <label class="form__label">Язык проведения мероприятия (*)</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form" data-name="lang">
                            <option value="ru" selected>Русский</option>
                            <option value="en">Английский</option>
                            <option value="mixed">Русский / Английский</option>
                            <option value="other">Другой</option>
                        </select>
						<template x-if="form.invalid('lang')">
							<div class="form__error" x-text="form.errors.lang"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('participants_number') && '_error'">
                        <label class="form__label">Количество участников</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form" data-name="participants_number">
                            <option value="50-" selected>До 50 человек</option>
                            <option value="50-100">50-100</option>
                            <option value="100-200">100-200</option>
                            <option value="200+">200 +</option>
                        </select>
						<template x-if="form.invalid('participants_number')">
							<div class="form__error" x-text="form.errors.participants_number"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('report_form') && '_error'">
                        <label class="form__label">Формы докладов</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form" data-name="report_form">
                            <option value="oral" selected>Устная</option>
                            <option value="stand">Стендовые доклады</option>
                            <option value="mixed">Смешанная</option>
                        </select>
						<template x-if="form.invalid('report_form')">
							<div class="form__error" x-text="form.errors.report_form"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('whatsapp') && '_error'">
                        <label class="form__label" for="c_10">Ссылка на Whatsapp мероприятия</label>
                        <input id="c_10" class="input" autocomplete="off" type="text" name="form[]"
                            placeholder="https://wa.me/791200000000"
							x-model="form.whatsapp"
							@change="form.validate('whatsapp')"
						>
						<template x-if="form.invalid('whatsapp')">
							<div class="form__error" x-text="form.errors.whatsapp"></div>
						</template>
                    </div>

                    <div class="form__row" :class="form.invalid('telegram') && '_error'">
                        <label class="form__label" for="c_11">Ссылка на Telegram мероприятия</label>
                        <input id="c_11" class="input" autocomplete="off" type="text" name="form[]"
                            placeholder="https://t.me/yournickname"
							x-model="form.telegram"
							@change="form.validate('telegram')"
						>
						<template x-if="form.invalid('telegram')">
							<div class="form__error" x-text="form.errors.telegram"></div>
						</template>
                    </div>

					<div class="form__row" :class="form.invalid('price_participants') && '_error'" x-data="{
						show: false,
						change() {
							if (this.show === false) {
								this.form.price_participants = ''
							}
						},
					}">
                        <label class="form__label">Оплата для участников (оргвзнос)</label>
                        <div class="checkbox">
                            <input id="chx_11" class="checkbox__input" type="checkbox"
                                value="1" name="price_participants_check" @change="change" x-model="show">
                            <label for="chx_11" class="checkbox__label">
                                <span class="checkbox__text">Есть</span>
                            </label>
                        </div>
                        <input class="input" autocomplete="off" type="text" name="form[]"
                            placeholder="Сумма оплаты" 
							x-show="show"
							x-transition
							x-model="form.price_participants"
							@change="form.validate('price_participants')"
						>
						<template x-if="form.invalid('price_participants') && show">
							<div class="form__error" x-text="form.errors.price_participants"></div>
						</template>
                    </div>

					<div class="form__row" :class="form.invalid('price_visitors') && '_error'" x-data="{
						show: false,
						change() {
							if (this.show === false) {
								this.form.price_visitors = ''
							}
						},
					}">
                        <label class="form__label">Оплата для посетителей</label>
                        <div class="checkbox">
                            <input id="chx_12" class="checkbox__input" type="checkbox"
                                value="1" name="price_visitors_check" @change="change" x-model="show">
                            <label for="chx_12" class="checkbox__label">
                                <span class="checkbox__text">Есть</span>
                            </label>
                        </div>
                         <input class="input" autocomplete="off" type="text" name="price_visitors"
                            placeholder="Сумма оплаты" 
							x-show="show"
							x-transition
							x-model="form.price_visitors"
							@change="form.validate('price_visitors')"
						>
						<template x-if="form.invalid('price_visitors') && show">
							<div class="form__error" x-text="form.errors.price_visitors"></div>
						</template>
                    </div>

					<div class="form__row" :class="form.invalid('abstracts_price') && '_error'" x-data="{
						show: false,
						change() {
							if (this.show === false) {
								this.form.abstracts_price = ''
							}
						},
					}">
                        <label class="form__label">Оплата тезисов от участников</label>
                        <div class="checkbox">
                            <input id="chx_13" class="checkbox__input" type="checkbox"
                                value="1" name="abstracts_price_check" @change="change" x-model="show">
                            <label for="chx_13" class="checkbox__label">
                                <span class="checkbox__text">Есть</span>
                            </label>
                        </div>
                         <input class="input" autocomplete="off" type="text"
                            placeholder="Сумма оплаты" 
							x-show="show"
							x-transition
							x-model="form.abstracts_price"
							@change="form.validate('abstracts_price')"
						>
						<template x-if="form.invalid('abstracts_price') && show">
							<div class="form__error" x-text="form.errors.abstracts_price"></div>
						</template>
                    </div>

                    <div class="form__row">
						<label class="form__label">Предоставление скидок</label>
						<div class="checkbox-block" 
							:class="form.invalid('discount_students') && '_error'"
							x-data="{
								show: false,

								change() {
									if (this.$el.checked) return
									this.form.discount_students.amount = ''
								}
							}"
						>
							<div class="checkbox">
								<input id="chx_3" class="checkbox__input" type="checkbox" x-model="show" @change="change">
								<label for="chx_3" class="checkbox__label">
									<span class="checkbox__text">Студенты</span>
								</label>
							</div>
							<div class="checkbox-block__input" x-show="show" x-transition>
								<div class="form__line">
									<input class="input" autocomplete="off" type="text" name="form[]" placeholder="Размер скидки"
										x-model="form.discount_students.amount"
										@change="form.validate('discount_students')"
									>
								</div>
								<div class="form__line">
									<select data-class-modif="form" data-name="discount_students_unit">
										<option value="RUB" selected>В рублях</option>
										<option value="percent">В %</option>
									</select>
								</div>
							</div>
							<template x-if="form.invalid('discount_students') && show">
								<div class="form__error" x-text="form.errors.discount_students"></div>
							</template>
						</div>
						<div class="checkbox-block"
							:class="form.invalid('discount_participants') && '_error'"
							x-data="{
								show: false,

								change() {
									if (this.$el.checked) return
									this.form.discount_participants.amount = ''
								}
							}"
						>
							<div class="checkbox">
								<input id="chx_4" checked class="checkbox__input" type="checkbox" x-model="show" @change="change">
								<label for="chx_4" class="checkbox__label">
									<span class="checkbox__text">Докладчик</span>
								</label>
							</div>
							<div class="checkbox-block__input" x-show="show" x-transition>
								<div class="form__line">
									<input class="input" autocomplete="off" type="text" placeholder="Размер скидки"
										x-model="form.discount_participants.amount"
										@change="form.validate('discount_participants')"
									>
								</div>
								<div class="form__line">
									<select data-name="discount_participants_unit" data-class-modif="form">
										<option value="RUB" selected>В рублях</option>
										<option value="percent">В %</option>
									</select>
								</div>
							</div>
							<template x-if="form.invalid('discount_participants') && show">
								<div class="form__error" x-text="form.errors.discount_participants"></div>
							</template>
						</div>
						<div class="checkbox-block"
							:class="form.invalid('discount_special_guest') && '_error'"
							x-data="{
								show: false,

								change() {
									if (this.$el.checked) return
									this.form.discount_special_guest.amount = ''
								}
							}"
						>
							<div class="checkbox">
								<input id="chx_5" class="checkbox__input" type="checkbox" x-model="show" @change="change">
								<label for="chx_5" class="checkbox__label">
									<span class="checkbox__text">Специальный гость</span>
								</label>
							</div>
							<div class="checkbox-block__input" x-show="show" x-transition>
								<div class="form__line">
									<input class="input" autocomplete="off" type="text" placeholder="Размер скидки"
										x-model="form.discount_special_guest.amount"
										@change="form.validate('discount_special_guest')"
									>
								</div>
								<div class="form__line">
									<select data-name="discount_special_guest_unit" data-class-modif="form">
										<option value="RUB" selected>В рублях</option>
										<option value="percent">В %</option>
									</select>
								</div>
							</div>
							<template x-if="form.invalid('discount_special_guest') && show">
								<div class="form__error" x-text="form.errors.discount_special_guest"></div>
							</template>
						</div>
						<div class="checkbox-block"
							:class="form.invalid('discount_young_scientist') && '_error'"
							x-data="{
								show: false,

								change() {
									if (this.$el.checked) return
									this.form.discount_young_scientist.amount = ''
								}
							}"
						>
							<div class="checkbox">
								<input id="chx_6" checked class="checkbox__input" type="checkbox" x-model="show" @change="change">
								<label for="chx_6" class="checkbox__label">
									<span class="checkbox__text">Молодой ученый до 35 лет</span>
								</label>
							</div>
							<div class="checkbox-block__input" x-show="show" x-transition>
								<div class="form__line">
									<input class="input" autocomplete="off" type="text" placeholder="Размер скидки"
										x-model="form.discount_young_scientist.amount"
										@change="form.validate('discount_young_scientist')"
									>
								</div>
								<div class="form__line">
									<select data-name="discount_young_scientist_unit" data-class-modif="form">
										<option value="RUB" selected>В рублях</option>
										<option value="percent">В %</option>
									</select>
								</div>
							</div>
							<template x-if="form.invalid('discount_young_scientist') && show">
								<div class="form__error" x-text="form.errors.discount_young_scientist"></div>
							</template>
						</div>
					</div>

                    {{-- <div class="form__row">
                        <label class="form__label">Что необходимо для конференции</label>
                        <div class="checkbox-items">
                            <div class="checkbox">
                                <input id="chx_12" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_12" class="checkbox__label">
                                    <span class="checkbox__text">Программа мероприятия</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_13" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_13" class="checkbox__label">
                                    <span class="checkbox__text">Сайт конференции с хостингом</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_14" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_14" class="checkbox__label">
                                    <span class="checkbox__text">Форма приема тезисов</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_15" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_15" class="checkbox__label">
                                    <span class="checkbox__text">Сервис для оплаты тезисов</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_16" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_16" class="checkbox__label">
                                    <span class="checkbox__text">Генерация бейджей для участников</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_17" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_17" class="checkbox__label">
                                    <span class="checkbox__text">Сервис для оплаты оргвзносов</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_18" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_18" class="checkbox__label">
                                    <span class="checkbox__text">Генерация сборника тезисов</span>
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form__row" :class="form.invalid('abstracts_format') && '_error'">
                        <label class="form__label">Формат сборника тезисов</label>
                        <select name="abstracts_format" data-scroll="500" data-class-modif="form" data-name="abstracts_format">
                            <option value="A4" selected>А4</option>
                            <option value="A5">А5</option>
                        </select>
						<template x-if="form.invalid('abstracts_format')">
							<div class="form__error" x-text="form.errors.abstracts_format"></div>
						</template>
                    </div>

                    {{-- <div class="form__row" :class="form.invalid('email') && '_error'">
                        <label class="form__label">Наполнение сборника тезисов</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>Цветное</option>
                            <option value="2">Черно-белое</option>
                        </select>
                    </div> --}}

                    <div class="form__row" :class="form.invalid('abstracts_lang') && '_error'">
                        <label class="form__label">Язык сборника тезисов</label>
                        <select name="abstracts_lang" data-scroll="500" data-class-modif="form" data-name="abstracts_lang">
                            <option value="ru" selected>Русский</option>
                            <option value="en">Английский</option>
                        </select>
						<template x-if="form.invalid('abstracts_lang')">
							<div class="form__error" x-text="form.errors.abstracts_lang"></div>
						</template>
                    </div>

					<div class="form__row" :class="form.invalid('max_thesis_characters') && '_error'">
                        <label class="form__label" for="c_21">Максимальное количество символов в тексте тезисов (*)</label>
                        <input id="c_21" class="input" autocomplete="off" type="text" name="max_thesis_characters"
                            placeholder="Максимальное количество символов в тексте тезисов"
							x-model="form.max_thesis_characters"	
							@input.debounce.1000ms="form.validate('max_thesis_characters')"
						>
						<template x-if="form.invalid('max_thesis_characters')">
							<div class="form__error" x-text="form.errors.max_thesis_characters"></div>
						</template>
                    </div>

					<div class="form__row _two">
                        <div class="form__line" :class="form.invalid('thesis_accept_until') && '_error'">
                            <label class="form__label" for="thesis_accept_until">Последний день подачи тезисов (*)</label>
                            <input id="thesis_accept_until" class="input" autocomplete="off" type="date"
                                placeholder="__.__.____"
								x-model="form.thesis_accept_until"
								@change="form.validate('thesis_accept_until')"
							>
                            <template x-if="form.invalid('thesis_accept_until')">
								<div class="form__error" x-text="form.errors.thesis_accept_until"></div>
							</template>
                        </div>
                        <div class="form__line" :class="form.invalid('thesis_edit_until') && '_error'">
                            <label class="form__label" for="thesis_edit_until">Последний день изменения тезисов (*)</label>
                            <input id="thesis_edit_until" class="input" autocomplete="off" type="date"
                                placeholder="__.__.____"
								x-model="form.thesis_edit_until"
								@change="form.validate('thesis_edit_until')"
							>
							<template x-if="form.invalid('thesis_edit_until')">
								<div class="form__error" x-text="form.errors.thesis_edit_until"></div>
							</template>
                        </div>
                    </div>

					<div class="form__row" :class="form.invalid('thesis_instruction') && '_error'">
                        <label class="form__label" for="t_1">Требования к оформлению тезисов</label>
                        <textarea id="t_1" autocomplete="off" name="thesis_instruction" placeholder="Требования к оформлению тезисов"
                            class="input"
							style="height: 300px"
							x-model="form.thesis_instruction"
							@change="form.validate('thesis_instruction')"
						></textarea>
						<template x-if="form.invalid('thesis_instruction')">
							<div class="form__error" x-text="form.errors.thesis_instruction"></div>
						</template>
                    </div>

                    <div class="form__row">
                        <button class="form__button button button_primary" type="submit"
							:disabled="form.processing || formDisabled"
						>
							Создать мероприятие
						</button>
                    </div>
                    <div class="form__row">
                        <template x-if="form.hasErrors">
							<div class="form__error">В форме есть ошибки</div>
						</template>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
