@extends('layouts.app')

@section('title', $title ?? 'Конференции')

@section('content')
	<main class="page">
        <div class="section-divider white-block">
            <div class="white-block__container">
                <div class="white-block__inner">
                    <nav class="white-block__breadcrumbs breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__item"><a href="#" class="breadcrumbs__link">Конференции</a></li>
							@isset($breadcrumbs)
								<li class="breadcrumbs__item">
									<span class="breadcrumbs__current">{{ $breadcrumbs }}</span>
								</li>
							@endisset 
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <section class="subject-result page-divider">
            <div class="subject-result__container">
                <div class="subject-result__items">
                    <div class="subject-result__item">
                        <h2 class="subject-result__title title-bg">
                            {{ $h1 ?? 'Все конференции' }} (<span>{{ $conferences->count() }}</span>)
                        </h2>
                        <ul class="subject-result__list list-result">
							@if ($conferences->isEmpty())
								<li class="list-result__item">
									Мероприятий не найдено
								</li>
							@else
								@foreach ($conferences as $conference)
									<li class="list-result__item">
										<div class="list-result__title">
											<a href="{{ localize_route('conference.show') }}">{{ $conference->{'title_'.app()->getLocale()} }}</a>
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
												<strong>Связанные темы:</strong>
												<span> Физика высоких энергий, Частицы и поля, Метрология и приборостроение</span>
											</div>
											<div class="body-result__item">
												<strong>Сайт мероприятия:</strong>
												<span><a href="https://www.ggi.infn.it/showevent.pl?id=437" target="_blank">https://www.ggi.infn.it/showevent.pl?id=437</a></span>
											</div>
										</div>
									</li>
								@endforeach
							@endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
