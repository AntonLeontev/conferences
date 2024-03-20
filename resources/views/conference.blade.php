@extends('layouts.app')

@section('title', $conference->{'title_'.loc()})

@section('content')
    <main class="page">
        <section class="event">
            <div class="event__container">
                <div class="event-item">
                    <div class="event-item__header header-item-event">
                        <div class="header-item-event__icon">
                            <img src="{{ Vite::asset('resources/img/user.jpg') }}" alt="Image">
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
                                <div class="descr-item" title="Стоимость для участников">
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
                                <div class="descr-item" title="Стоимость для посетителей">
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
                                <div class="descr-item" title="Стоимость отправки тезисов">
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
									@if ($conference->whatsapp || $conference->telegram)
										<div class="contacts-event _flex">
											<span>Мессенджеры: </span>
											<div class="contacts-event__icons">
												@if ($conference->whatsapp)
													<a href="{{ $conference->whatsapp }}" target="_blank">
														<img src="{{ Vite::asset('resources/img/icons/wp.svg') }}" alt="WhatsApp-icon">
													</a>
												@endif
												@if ($conference->telegram)
													<a href="{{ $conference->telegram }}" target="_blank">
														<img src="{{ Vite::asset('resources/img/icons/tg.svg') }}" alt="Telegram-icon">
													</a>
												@endif
											</div>
										</div>
									@endif
                                </div>
                            </li>
							@unless (empty($conference->website))
								<li>
									<strong>Сайт мероприятия:</strong>
									<a href="{{ $conference->website }}" target="_blank" rel="nofollow">{{ $conference->website }}</a>
								</li>
							@endunless
							@auth
								@can ('viewParticipations', $conference)
									<li>
										<a href="{{ route('conference.participations', $conference->slug) }}" class="button button_primary">Управление мероприятием</a>
									</li>
								@endcan
							@endauth
                        </ul>
                    </div>
					@auth
						@if (auth()->user()->participant && $conference->end_date > now())
							<div class="event-item__footer _border">
								@if ($participation)
									<div class="theses">
										<div class="theses__title">
											Список ваших тезисов:
										</div>
										@if ($participation->theses->isNotEmpty())
											<ol class="theses__list" x-data="theses">
												@foreach ($participation->theses as $thesis)
													<li class="">
														<div class="tw-flex tw-justify-between tw-items-center tw-gap-3">
															@if ($conference->thesis_edit_until?->endOfDay()->isPast())
																<span>{!! $thesis->title !!}</span>
															@else
																<a href="{{ route('theses.edit', [$conference->slug, $thesis->id]) }}">
																	{!! $thesis->title !!}
																</a>
															@endif

															<div class="tw-items-center tw-flex tw-gap-1">
																@if ($conference->thesis_edit_until?->endOfDay()->isFuture())
																	<a href="{{ route('theses.edit', [$conference->slug, $thesis->id]) }}" class="!tw-text-[#000000] hover:!tw-text-[#1e4759] tw-transition">
																		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
																			<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
																		</svg>
																	</a>
																@endif
																@if ($conference->thesis_accept_until?->endOfDay()->isFuture())
																	<button class="hover:tw-text-[#e25553] tw-transition" 
																		title="Отозвать и удалить тезисы" 
																		@click="deleteThesis({{ $thesis->id }}, '{{ $thesis->title }}', '{{ $thesis->thesis_id }}')"
																	>
																		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
																			<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
																		</svg>

																	</button>
																@endif
															</div>
														</div>
													</li>
												@endforeach
											</ol>
											<script>
												document.addEventListener('alpine:init', () => {
													Alpine.data('theses', () => ({
														deleteThesis(id, title, thesisId) {
															if (confirm(`Тезисы ${thesisId}, ${title} будут отзваны. Это действие необратимо. Если Вы хотите отредактировать тезисы, нажмите кнопку редактирования. Отозвать и удалить?`)) {
																axios
																	.delete(route('theses.destroy', id))
																	.then(resp => location.reload())
																	.catch(err => alert('Ошибка удаления'))
															}
														},
													}))
												})
											</script>
										@else
											<p>Вы еще не отправляли тезисы</p>
										@endif
									</div>

									@if ($participation->theses->isNotEmpty())
										@if ($conference->thesis_edit_until?->endOfDay()->isPast())
											<p class="tw-mb-4">Редактирование тезисов закрыто организатором мероприятия</p>
										@else
											<p class="tw-mb-4">Тезисы можно изменить до {{ $conference->thesis_edit_until?->translatedFormat('j F Y') }} включительно</p>
										@endif
									@endif

									@if ($conference->thesis_accept_until?->endOfDay()->isPast())
										<p class="tw-mb-4">Прием тезисов завершен</p>
									@else
										<p class="tw-mb-4">Тезисы можно подать до {{ $conference->thesis_accept_until?->translatedFormat('j F Y') }} включительно</p>
										<a href="{{ localize_route('theses.create', $conference->slug) }}" class="button">Отправить тезисы</a>
									@endif

									@if ($conference->thesis_edit_until?->endOfDay()->isFuture())
										<a href="{{ localize_route('participation.edit', $conference->slug) }}" class="button">Редактировать заявку</a>
									@endif
								@else
									<a href="{{ route('participation.create', $conference->slug) }}" class="button button_primary" type="submit">
										Принять участие
									</a>
								@endif
							</div>
						@endif
					@endauth
					@if ($conference->end_date < now())
						<p>Конференция завершилась</p>
					@endif
                </div>
            </div>
        </section>
    </main>
@endsection
