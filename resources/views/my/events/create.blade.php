@extends('layouts.app')

@section('title', __('my/events/create.title'))

@section('content')
    <main class="page">
        <section class="event">
            <div class="event__container">
                <h1 class="event__title">Создать мероприятие</h1>
                <form action="#" class="event__form form" 
					@select-callback.camel.document="select"
					x-data="{
						form: {},

						select() {
							let item = this.$event.detail.select.parentElement.querySelector('.select__content').innerText

							console.log(item)
							{{-- this.form.type = item
							if (item === 'Другое') {
								this.other = true
								this.form.type = ''
							} else {
								this.other = false
							} --}}
						},
					}"
				>
                    <div class="form__row _error">
                        <label class="form__label" for="c_1">Название мероприятия RU (*)</label>
                        <input id="c_1" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="Название мероприятия">
                        <div class="form__error">
                            Неправильно введен пароль
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="c_2">Название мероприятия ENG (*)</label>
                        <input id="c_2" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="Event name">

                    </div>

                    <div class="form__row">
                        <label class="form__label">Тип мероприятия (*)</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>Конференция</option>
                            <option value="2">Семинар</option>
                            <option value="3">Школа-семинар</option>
                            <option value="4">Мастер-класс</option>
                            <option value="5">Презентация</option>
                            <option value="6">Выставка</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Формат мероприятия (*)</label>
                        <select name="form[]" data-scroll="500" data-class-modif="format">
                            <option value="1" selected>Национальное</option>
                            <option value="2">Международное мероприятие</option>
                            <option value="3">Привлеченные иностранцы</option>
                        </select>
                        <div class="checkbox">
                            <input id="chx_1" data-error="Ошибка" class="checkbox__input" type="checkbox" value="1"
                                name="form[]">
                            <label for="chx_1" class="checkbox__label">
                                <span class="checkbox__text">С международным участием</span>
                            </label>
                        </div>
                    </div>

                    {{-- <div class="form__row">
							<label class="form__label" for="c_3">Название организации RU (*)</label>
							<div class="form__line">
								<input class="input" id="c_3" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Полное название">
							</div>
							<div class="form__line">
								<input class="input" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Аббревиатура">
							</div>
						</div>

						<div class="form__row">
							<label class="form__label" for="c_4">Название организации ENG (*)</label>
							<div class="form__line">
								<input class="input" id="c_4" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Full name">
							</div>
							<div class="form__line">
								<input class="input" autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Abbreviation">
							</div>
						</div> --}}

                    <div class="form__row">
                        <label class="form__label">Тематика мероприятия (*)</label>
                        <select name="form[]" data-scroll="500" multiple data-class-modif="format">
                            @foreach (subjects() as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->{'title_' . app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Список секций</label>
                        <div class="form-list">
                            <label class="form-list__label">Название секции</label>
                            <input class="input" autocomplete="off" type="text" name="form[]" data-error="Ошибка"
                                placeholder="Секция 1">
                            <input class="input" autocomplete="off" type="text" name="form[]" data-error="Ошибка"
                                placeholder="Секция 2">
                            <button class="button button_outline" type="button">Убрать секцию</button>
                        </div>
                        <button class="button" type="button">Добавить секцию</button>
                    </div>

                    <div class="form__row">
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
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="c_5">Сайт мероприятия</label>
                        <div class="d-grid">
                            <input id="c_5" class="input" autocomplete="off" type="text" name="form[]"
                                data-error="Ошибка" placeholder="website.com">
                            <div class="checkbox">
                                <input id="chx_2" data-error="Ошибка" class="checkbox__input" type="checkbox"
                                    value="1" name="form[]">
                                <label for="chx_2" class="checkbox__label">
                                    <span class="checkbox__text">Мне нужен сайт для мероприятия</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="form__row">
                        <div class="form__line">
                            <label class="form__label" for="c_6">Соорганизаторы мероприятия</label>

                            <input id="c_6" class="input" autocomplete="off" type="text" name="form[]"
                                data-error="Ошибка" placeholder="Название организации">
                        </div>
                        <div class="form__line">
                            <div class="form-list">
                                <input class="input" autocomplete="off" type="text" name="form[]"
                                    data-error="Ошибка" placeholder="Название организации 1">
                                <input class="input" autocomplete="off" type="text" name="form[]"
                                    data-error="Ошибка" placeholder="Название организации 2">
                                <button class="button button_outline" type="button">Убрать соорганизатора</button>

                            </div>
                            <button class="button" type="button">Добавить соорганизатора</button>
                        </div>

                    </div>

                    <div class="form__row" x-data="{
						suggestions: [],
						show: false,
					}">
                        <label class="form__label" for="c_7">Адрес проведения мероприятия (*) </label>
                        <input id="c_7" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="Полный адрес">
                        <div class="input-tips" style="display: none" x-show="show" x-transition>
                            <ul>
                                <li>Санкт-Петербург, ул. Попова, д.5 </li>
                            </ul>
                        </div>

                    </div>

                    <div class="form__row">
                        <label class="form__label" for="c_8">Контактный телефон службы поддержки мероприятия </label>
                        <input id="c_8" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="Телефон">

                    </div>

                    <div class="form__row">
                        <label class="form__label" for="c_9">Электронная почта службы поддержки мероприятия
                            (*)</label>
                        <input id="c_9" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="mail@mail.ru">

                    </div>

                    <div class="form__row _two">
                        <div class="form__line _error">
                            <label class="form__label" for="date-start">Дата начала мероприятия (*)</label>
                            <input id="date-start" class="input" autocomplete="off" type="date" name="form[]"
                                data-error="Ошибка" placeholder="__.__.____">
                            <div class="form__error">
                                Неправильно введен пароль
                            </div>
                        </div>
                        <div class="form__line">
                            <label class="form__label" for="date-start">Дата окончания мероприятия (*)</label>
                            <input id="date-end" class="input" autocomplete="off" type="date" name="form[]"
                                data-error="Ошибка" placeholder="__.__.____">
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="t_1">Описание мероприятия RU (*)</label>
                        <textarea id="t_1" autocomplete="off" name="form[]" placeholder="Описание" data-error="Ошибка"
                            class="input _small"></textarea>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="t_2">Описание мероприятия ENG (*)</label>
                        <textarea id="t_2" autocomplete="off" name="form[]" placeholder="Description" data-error="Ошибка"
                            class="input _small"></textarea>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Язык проведения мероприятия (*)</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>Русский</option>
                            <option value="2">Английский</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Количество участников</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>До 50 человек</option>
                            <option value="2">50-100</option>
                            <option value="3">100-200</option>
                            <option value="4">200 +</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Формы докладов</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>Устная</option>
                            <option value="2">Стендовые доклады</option>
                            <option value="3">Смешанная</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="c_10">Ссылка на Whatsapp мероприятия</label>
                        <input id="c_10" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="//////">

                    </div>

                    <div class="form__row">
                        <label class="form__label" for="c_11">Ссылка на Telegram мероприятия</label>
                        <input id="c_11" class="input" autocomplete="off" type="text" name="form[]"
                            data-error="Ошибка" placeholder="//////">

                    </div>

                    <div class="form__row">
                        <label class="form__label">Предоставление скидок</label>

                        <div class="checkbox">
                            <input id="chx_3" data-error="Ошибка" class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_3" class="checkbox__label">
                                <span class="checkbox__text">Студенты</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input id="chx_4" data-error="Ошибка" checked class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_4" class="checkbox__label">
                                <span class="checkbox__text">Докладчик</span>
                            </label>
                        </div>

                    </div>

                    <div class="form__row _two">
                        <div class="form__line">

                            <input class="input" autocomplete="off" type="text" name="form[]" data-error="Ошибка"
                                placeholder="Размер скидки">
                        </div>
                        <div class="form__line">
                            <select name="form[]" data-class-modif="form">
                                <option value="1" selected>В рублях</option>
                                <option value="2">В %</option>
                            </select>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="checkbox">
                            <input id="chx_5" data-error="Ошибка" class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_5" class="checkbox__label">
                                <span class="checkbox__text">Специальный гость</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input id="chx_6" data-error="Ошибка" checked class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_6" class="checkbox__label">
                                <span class="checkbox__text">Молодой ученый до 35 лет</span>
                            </label>
                        </div>

                    </div>

                    <div class="form__row">
                        <label class="form__label">Бесплатное участие</label>

                        <div class="checkbox">
                            <input id="chx_7" data-error="Ошибка" class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_7" class="checkbox__label">
                                <span class="checkbox__text">Студенты</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input id="chx_8" data-error="Ошибка" checked class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_8" class="checkbox__label">
                                <span class="checkbox__text">Докладчик</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input id="chx_9" data-error="Ошибка" class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_9" class="checkbox__label">
                                <span class="checkbox__text">Специальный гость</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input id="chx_10" data-error="Ошибка" checked class="checkbox__input" type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_10" class="checkbox__label">
                                <span class="checkbox__text">Молодой ученый до 35 лет</span>
                            </label>
                        </div>

                    </div>

                    <div class="form__row">
                        <label class="form__label">Оплата тезисов от участников</label>
                        <div class="checkbox">
                            <input id="chx_11" data-error="Ошибка" class="checkbox__input" checked type="checkbox"
                                value="1" name="form[]">
                            <label for="chx_11" class="checkbox__label">
                                <span class="checkbox__text">Есть</span>
                            </label>
                        </div>
                        <input class="input" autocomplete="off" type="text" name="form[]" data-error="Ошибка"
                            placeholder="Сумма оплаты">
                    </div>

                    <div class="form__row">
                        <label class="form__label">Что необходимо для конференции</label>
                        <div class="checkbox-items">
                            <div class="checkbox">
                                <input id="chx_12" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_12" class="checkbox__label">
                                    <span class="checkbox__text">Программа мероприятия</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_13" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_13" class="checkbox__label">
                                    <span class="checkbox__text">Сайт конференции с хостингом</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_14" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_14" class="checkbox__label">
                                    <span class="checkbox__text">Форма приема тезисов</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_15" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_15" class="checkbox__label">
                                    <span class="checkbox__text">Сервис для оплаты тезисов</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_16" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_16" class="checkbox__label">
                                    <span class="checkbox__text">Генерация бейджей для участников</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_17" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_17" class="checkbox__label">
                                    <span class="checkbox__text">Сервис для оплаты оргвзносов</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input id="chx_18" data-error="Ошибка" class="checkbox__input" checked
                                    type="checkbox" value="1" name="form[]">
                                <label for="chx_18" class="checkbox__label">
                                    <span class="checkbox__text">Генерация сборника тезисов</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Формат сборника тезисов</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>А4</option>
                            <option value="2">А5</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Наполнение сборника тезисов</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>Цветное</option>
                            <option value="2">Черно-белое</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label">Язык сборника тезисов</label>
                        <select name="form[]" data-scroll="500" data-class-modif="form">
                            <option value="1" selected>Русский</option>
                            <option value="2">Английский</option>
                        </select>
                    </div>

                    <div class="form__row">
                        <button class="form__button button button_primary" type="submit">Создать мероприятие</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
