@extends('layouts.app')

@section('title', 'Архив')

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
        <section class="subject-result page-divider">
            <div class="subject-result__container">
                <h2 class="search-result__title title">
                    Прошедшие конференции
                </h2>
                <div class="subject-result__items">
                    <div class="subject-result__item">
                        <ol class="subject-result__list list-result">
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href="">Аксионы преодолевают границы между физикой элементарных частиц,
                                        астрофизикой, космологией и передовыми технологиями обнаружения</a>
                                </div>
                                <div class="list-result__details">
                                    <time>26 апреля 2023 - 09 июня 2023</time>
                                    <strong>Институт теоретической физики Галилео Галилея, Флоренция, Италия</strong>
                                </div>
                                <div class="list-result__body body-result">
                                    <div class="body-result__item">
                                        <strong>Организатор:</strong>
                                        <span> Институт Галилео Галилея</span>
                                    </div>
                                    <div class="body-result__text">
                                        <strong>Аннотация:</strong> Цель этого семинара — собрать вместе ученых с разным опытом и
                                        знаниями для обсуждения открытых проблем, последних разработок и будущих
                                        направлений в аксионной физике, области, которая, как известно, изобилует
                                        междисциплинарными связями. Цель состоит в том, чтобы способствовать
                                        плодотворному скрещиванию различных теоретических областей с акцентом на
                                        определенные открытые вопросы в физике аксионных частиц, астрофизике и
                                        космологии. Количественные оценки аксионного вклада в холодную темную материю
                                        (CDM) включают первоклассное решеточное моделирование непертурбативных эффектов
                                        КХД, а также космической эволюции аксионных топологических дефектов.
                                        Астрофизические наблюдения дают четкие ограничения на свойства аксионов,
                                        поскольку существование аксионов будет влиять на эволюцию звезд, и, что
                                        интересно, сообщалось о некоторых превышениях потерь энергии звезд.
                                        Космологические сценарии, в которых симметрия PQ нарушается до инфляции,
                                        предусматривают отпечатки аксионов в реликтовом излучении, в то время как в
                                        постинфляционных сценариях ожидается формирование аксионных миникластеров со
                                        сверхплотностью, на несколько порядков превышающих локальную плотность CDM, и
                                        надежная оценка. их свойств имеет первостепенное значение. С экспериментальной
                                        точки зрения, расцвет идей, потенциально меняющих правила игры, с захватывающим
                                        переходом от экспериментальной физики элементарных частиц к материаловедению и
                                        передовым технологиям вдохновляет на новые методы поиска аксионов. Были
                                        предложены новые методы, которые, помимо использования аксионно-фотонной связи,
                                        направлены на выявление аксионов через их связь с нуклонами и электронами.
                                        Взаимодействие между экспериментальным и теоретическим сообществами будет
                                        способствовать слиянию вопросов «как искать» и «где искать» в оптимизированные
                                        стратегии охоты за аксионом.
                                    </div>
                                    <div class="body-result__item">
                                        <strong>Идентификатор события:</strong>
                                        <span> 1522340</span>
                                    </div>
                                    <div class="body-result__item">
                                        <a class="link" href="">Аннотация Архив</a>
                                    </div>
                                    <div class="body-result__item">
                                        <strong>Сайт мероприятия:</strong>
                                        <span><a href="https://www.ggi.infn.it/showevent.pl?id=437" target="_blank">https://www.ggi.infn.it/showevent.pl?id=437</a></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href="">Аксионы преодолевают границы между физикой элементарных частиц,
                                        астрофизикой, космологией и передовыми технологиями обнаружения</a>
                                </div>
                                <div class="list-result__details">
                                    <time>26 апреля 2023 - 09 июня 2023</time>
                                    <strong>Институт теоретической физики Галилео Галилея, Флоренция, Италия</strong>
                                </div>
                                <div class="list-result__body body-result">
                                    <div class="body-result__item">
                                        <strong>Организатор:</strong>
                                        <span> Институт Галилео Галилея</span>
                                    </div>
                                    <div class="body-result__text">
                                        <strong>Аннотация:</strong> Цель этого семинара — собрать вместе ученых с разным опытом и
                                        знаниями для обсуждения открытых проблем, последних разработок и будущих
                                        направлений в аксионной физике, области, которая, как известно, изобилует
                                        междисциплинарными связями. Цель состоит в том, чтобы способствовать
                                        плодотворному скрещиванию различных теоретических областей с акцентом на
                                        определенные открытые вопросы в физике аксионных частиц, астрофизике и
                                        космологии. Количественные оценки аксионного вклада в холодную темную материю
                                        (CDM) включают первоклассное решеточное моделирование непертурбативных эффектов
                                        КХД, а также космической эволюции аксионных топологических дефектов.
                                        Астрофизические наблюдения дают четкие ограничения на свойства аксионов,
                                        поскольку существование аксионов будет влиять на эволюцию звезд, и, что
                                        интересно, сообщалось о некоторых превышениях потерь энергии звезд.
                                        Космологические сценарии, в которых симметрия PQ нарушается до инфляции,
                                        предусматривают отпечатки аксионов в реликтовом излучении, в то время как в
                                        постинфляционных сценариях ожидается формирование аксионных миникластеров со
                                        сверхплотностью, на несколько порядков превышающих локальную плотность CDM, и
                                        надежная оценка. их свойств имеет первостепенное значение. С экспериментальной
                                        точки зрения, расцвет идей, потенциально меняющих правила игры, с захватывающим
                                        переходом от экспериментальной физики элементарных частиц к материаловедению и
                                        передовым технологиям вдохновляет на новые методы поиска аксионов. Были
                                        предложены новые методы, которые, помимо использования аксионно-фотонной связи,
                                        направлены на выявление аксионов через их связь с нуклонами и электронами.
                                        Взаимодействие между экспериментальным и теоретическим сообществами будет
                                        способствовать слиянию вопросов «как искать» и «где искать» в оптимизированные
                                        стратегии охоты за аксионом.
                                    </div>
                                    <div class="body-result__item">
                                        <strong>Идентификатор события:</strong>
                                        <span> 1522340</span>
                                    </div>
                                    <div class="body-result__item">
                                        <a class="link" href="">Аннотация Архив</a>
                                    </div>
                                    <div class="body-result__item">
                                        <strong>Сайт мероприятия:</strong>
                                        <span><a href="https://www.ggi.infn.it/showevent.pl?id=437" target="_blank">https://www.ggi.infn.it/showevent.pl?id=437</a></span>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
