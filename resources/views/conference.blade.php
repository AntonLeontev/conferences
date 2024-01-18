@extends('layouts.app')

@section('title', $conference->{'title_'.loc()})

@section('content')
    <main class="page">
        <section class="event">
            <div class="event__container">
                <div class="event-item">
                    <div class="event-item__header header-item-event">
                        <div class="header-item-event__icon">
                            <img src="" alt="Image">
                        </div>
                        <div class="header-item-event__info">
                            <h3 class="header-item-event__title">
                                {{ $conference->{'title_'.loc()} }}
                            </h3>
                            <div class="header-item-event__time">
                                <time>{{ $conference->start_date->translatedFormat('d M Y') }} - {{ $conference->end_date->translatedFormat('d M Y') }}</time>
								@if ($conference->organization->{'short_name_'.loc()})
                                	<span>{{ $conference->organization->{'short_name_'.loc()} }}</span>
								@else
                                	<span>{{ $conference->organization->{'full_name_'.loc()} }}</span>
								@endif
                            </div>
                            <div class="header-item-event__descr">
                                <div class="descr-item">
                                    <div class="descr-item__img">
                                        <img src="{{ Vite::asset('resources/img/icons/student.svg') }}" alt="Image">
                                    </div>
                                    <div class="descr-item__text">
										@if (is_null($conference->price_participants))
											Бесплатно
										@else
                                        	{{ $conference->price_participants }} ₽
										@endif
                                    </div>
                                </div>
                                <div class="descr-item">
                                    <div class="descr-item__img">
                                        <img src="{{ Vite::asset('resources/img/icons/projector.svg') }}" alt="Image">
                                    </div>
                                    <div class="descr-item__text">
										@if (is_null($conference->price_visitors))
											Бесплатно
										@else
                                        	{{ $conference->price_visitors }} ₽
										@endif
                                    </div>
                                </div>
                                <div class="descr-item">
                                    <div class="descr-item__img">
                                        <img src="{{ Vite::asset('resources/img/icons/star.svg') }}" alt="Image">
                                    </div>
                                    <div class="descr-item__text">
										@if (is_null($conference->abstracts_price))
											Бесплатно
										@else
                                        	{{ $conference->abstracts_price }} ₽
										@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-item__body">
                        <ul>
                            <li><strong>Организатор: </strong>
								{{ $conference->organization->{'full_name_'.loc()} }}
                            </li>
                            <li><strong>Описание: </strong>{{ $conference->{'description_'.loc()} }}
                            </li>
                            <li>
								<strong>Тематика: </strong>
								@foreach ($conference->subjects as $subject)
									<span>
										<a href="{{ localize_route('subject', $subject->slug) }}">
											{{ $subject->{'title_'.loc()} }}
										</a>
									</span>
									@unless ($loop->last)
										<span>|</span>
									@endunless
								@endforeach
							</li>
                            <li class="d-flex">
                                <strong>Контакты: </strong>
                                <div class="event-item__contacts">
									@unless (empty($conference->phone))
										<div class="contacts-event">
											<span>Телефон: </span><a href="tel:{{ $conference->phone->clean() }}">{{ $conference->phone->raw() }}</a>
										</div>
									@endunless
									@unless (empty($conference->email))
										<div class="contacts-event">
											<span>Почта: </span><a
												href="mailto:{{ $conference->email }}">{{ $conference->email }}</a>
										</div>
									@endunless
									@unless (empty($conference->address))
										<div class="contacts-event">
											<span>Адрес: </span>
											<a target="_blank" rel="nofollow" href="https://yandex.ru/maps/?text={{ $conference->address }}">{{ $conference->address }}</a>
										</div>
									@endunless
                                </div>
                            </li>
							@unless (empty($conference->website))
								<li>
									<strong>Сайт мероприятия:</strong>
									<a href="{{ $conference->website }}" target="_blank" rel="nofollow">{{ $conference->website }}</a>
								</li>
							@endunless
                        </ul>
                    </div>
                    <div class="event-item__footer">
						@auth
							@if (auth()->user()->participant)
                        		<a href="" class="button button_primary" type="submit">Принять участие</a>
							@endif
							@if (auth()->user()->organization?->id === $conference->organization_id)
                        		<a href="" class="button button_primary" type="submit">Редактировать</a>
							@endif
						@endauth
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
