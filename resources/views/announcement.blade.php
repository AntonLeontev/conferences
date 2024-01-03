@extends('layouts.app')

@section('title', 'Объявление')

@section('content')
	<main class="page">
        <div class="section-divider white-block">
            <div class="white-block__container">
                <div class="white-block__inner">
                    <form action="#" class="white-block__form form">
                        <div class="form__column">
                            <label class="form__label" data-scroll="500" for="s_1">Тема конференции</label>
                            <select name="conference" id="s_1" data-class-modif="conference">
                                <option value="1" selected>Все</option>
                                <option value="2">Математика</option>
                                <option value="3">Информатика</option>
                                <option value="4">Медицина</option>
                            </select>
                        </div>
                        <div class="form__column">
                            <label class="form__label" data-scroll="500" for="s_2">Страна</label>
                            <select name="location" id="s_2" data-class-modif="location">
                                <option value="1" selected>Все</option>
                                <option value="2">Италия</option>
                                <option value="3">Германия</option>
                                <option value="4">Россия</option>
                            </select>
                        </div>
                        <div class="form__column">
                            <label class="form__label" for="i_1">Дата</label>

                            <input class="form__input input input-date" id="i_1" autocomplete="off" type="date"
                                   name="form[]" data-error="Ошибка"
                                   placeholder="">
                        </div>
                        <div class="form__column">
                            <button class="form__button button" type="submit">Найти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <section class="search-result page-divider">
            <div class="search-result__container">
                <h2 class="search-result__title title">
                    Ближайшие конференции
                </h2>
                <div class="search-result__items">
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Математика
                        </div>
                        <div class="search-result-item__body">
                            <div class="search-result-item__title">
                                Семинар по границам теории множеств
                            </div>
                            <div class="search-result-item__details">
                                <small>Июнь 05, 2023</small>
                                <small>Институт Филдса</small>
                            </div>
                            <div class="search-result-item__text">
                                Данный семинар будет носить менее целенаправленный характер и объединит небольшие группы
                                экспертов, которые будут заниматься вопросами новых приложений теории множеств.
                                экспертов, сосредоточенных на новых приложениях теории множеств. В их число войдут
                                Применение теории множеств в алгебраической топологииЭтот семинар будет иметь менее
                                целенаправленный характер и объединит небольшие группы экспертов, ориентированных на
                                новые приложения теории множеств. В частности, речь пойдет о приложениях теории множеств
                                в алгебраической топологии
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Математика
                        </div>
                        <div class="search-result-item__body">
                            <div class="search-result-item__title">
                                Семинар по границам теории множеств
                            </div>
                            <div class="search-result-item__details">
                                <small>Июнь 05, 2023</small>
                                <small>Институт Филдса</small>
                            </div>
                            <div class="search-result-item__text">
                                Данный семинар будет носить менее целенаправленный характер и объединит небольшие группы
                                экспертов, которые будут заниматься вопросами новых приложений теории множеств.
                                экспертов, сосредоточенных на новых приложениях теории множеств. В их число войдут
                                Применение теории множеств в алгебраической топологииЭтот семинар будет иметь менее
                                целенаправленный характер и объединит небольшие группы экспертов, ориентированных на
                                новые приложения теории множеств. В частности, речь пойдет о приложениях теории множеств
                                в алгебраической топологии
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Математика
                        </div>
                        <div class="search-result-item__body">
                            <div class="search-result-item__title">
                                Семинар по границам теории множеств
                            </div>
                            <div class="search-result-item__details">
                                <small>Июнь 05, 2023</small>
                                <small>Институт Филдса</small>
                            </div>
                            <div class="search-result-item__text">
                                Данный семинар будет носить менее целенаправленный характер и объединит небольшие группы
                                экспертов, которые будут заниматься вопросами новых приложений теории множеств.
                                экспертов, сосредоточенных на новых приложениях теории множеств. В их число войдут
                                Применение теории множеств в алгебраической топологииЭтот семинар будет иметь менее
                                целенаправленный характер и объединит небольшие группы экспертов, ориентированных на
                                новые приложения теории множеств. В частности, речь пойдет о приложениях теории множеств
                                в алгебраической топологии
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
