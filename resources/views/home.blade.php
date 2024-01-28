@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <main class="page">
        {{-- <div class="section-divider white-block">
            <div class="white-block__container">
                <div class="white-block__inner">
                    <form action="#" class="white-block__form form">
                        <div class="form__column">
                            <label class="form__label" data-scroll="500" for="s_1">Тема конференции</label>
                            <select id="s_1" name="conference" data-class-modif="conference">
                                <option value="1" selected>Все</option>
                                <option value="2">Математика</option>
                                <option value="3">Информатика</option>
                                <option value="4">Медицина</option>
                            </select>
                        </div>
                        <div class="form__column">
                            <label class="form__label" data-scroll="500" for="s_2">Страна</label>
                            <select id="s_2" name="location" data-class-modif="location">
                                <option value="1" selected>Все</option>
                                <option value="2">Италия</option>
                                <option value="3">Германия</option>
                                <option value="4">Россия</option>
                            </select>
                        </div>
                        <div class="form__column">
                            <label class="form__label" for="i_1">Дата</label>

                            <input id="i_1" class="form__input input input-date" autocomplete="off" type="date"
                                name="form[]" data-error="Ошибка" placeholder="">
                        </div>
                        <div class="form__column">
                            <button class="form__button button" type="submit">Найти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <section class="search-result section-divider">
            <div class="search-result__container">
                <h2 class="search-result__title title">
                    Ближайшие конференции
                </h2>
                <div class="search-result__items">
					@if ($closest->isEmpty())
						Конференций не запланировано
					@else
						@foreach ($closest as $conference)
							<div class="search-result-item">
								<div class="search-result-item__header">
									@foreach ($conference->subjects as $subject)
										<span>{{ $subject->{'title_'.loc()} }}</span>

										@if (!$loop->last)
											<span>|</span>
										@endif
									@endforeach
								</div>
								<div class="search-result-item__body">
									<div class="search-result-item__title">
										{{ $conference->{'title_'.loc()} }}
									</div>
									<div class="search-result-item__details">
										<small>{{ $conference->start_date->translatedFormat('d M y') }}</small>
										<small>{{ $conference->organization->{'full_name_'.loc()} }}</small>
									</div>
									<div class="search-result-item__text">
										{{ $conference->{'description_'.loc()} }}
									</div>
									<a href="{{ route('conference.show', $conference->slug) }}" class="search-result-item__link">
										Читать полностью
									</a>
								</div>
							</div>
						@endforeach
					@endif
                </div>
            </div>
        </section>
        {{-- <section class="search-result page-divider">
            <div class="search-result__container">
                <h2 class="search-result__title title">
                    Рекомендации
                </h2>
                <div class="search-result__items">
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Информатика
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
                                Устойчивое развитие представляет интерес в первую очередь в контексте очного
                                мероприятия, когда в организационном комитете есть специальный председатель по
                                устойчивому развитию
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Информатика
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
                                Устойчивое развитие представляет интерес в первую очередь в контексте очного
                                мероприятия, когда в организационном комитете есть специальный председатель по
                                устойчивому развитию
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Информатика
                        </div>
                        <div class="search-result-item__body">
                            <div class="search-result-item__title">
                                Международная конференция "Информационно-коммуникационные технологии для устойчивого
                                развития
                            </div>
                            <div class="search-result-item__details">
                                <small>Июнь 05, 2023</small>
                                <small>Институт Филдса</small>
                            </div>
                            <div class="search-result-item__text">
                                Устойчивое развитие представляет интерес в первую очередь в контексте очного
                                мероприятия, когда в организационном комитете есть специальный председатель по
                                устойчивому развитию
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Информатика
                        </div>
                        <div class="search-result-item__body">
                            <div class="search-result-item__title">
                                Международная конференция "Информационно-коммуникационные технологии для устойчивого
                                развития
                            </div>
                            <div class="search-result-item__details">
                                <small>Июнь 05, 2023</small>
                                <small>Институт Филдса</small>
                            </div>
                            <div class="search-result-item__text">
                                Устойчивое развитие представляет интерес в первую очередь в контексте очного
                                мероприятия, когда в организационном комитете есть специальный председатель по
                                устойчивому развитию
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                    <div class="search-result-item">
                        <div class="search-result-item__header">
                            Информатика
                        </div>
                        <div class="search-result-item__body">
                            <div class="search-result-item__title">
                                Международная конференция "Информационно-коммуникационные технологии для устойчивого
                                развития
                            </div>
                            <div class="search-result-item__details">
                                <small>Июнь 05, 2023</small>
                                <small>Институт Филдса</small>
                            </div>
                            <div class="search-result-item__text">
                                Устойчивое развитие представляет интерес в первую очередь в контексте очного
                                мероприятия, когда в организационном комитете есть специальный председатель по
                                устойчивому развитию
                            </div>
                            <a href="" class="search-result-item__link">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
@endsection
