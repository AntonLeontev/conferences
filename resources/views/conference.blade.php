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
								@if ($conference->end_date > now())
									@if (auth()->user()->organization?->id === $conference->organization_id)
										<li>
											<a href="{{ route('conference.edit', $conference->slug) }}" class="button button_primary">Управление мероприятием</a>
										</li>
									@endif
								@endif
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
															@if ($conference->thesis_accept_until?->endOfDay()->isFuture())
																<button class="hover:tw-text-[#e25553] tw-transition" 
																	title="Отозвать и удалить тезисы" 
																	@click="deleteThesis({{ $thesis->id }}, '{{ $thesis->title }}', '{{ $thesis->thesis_id }}')"
																>
																	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
																		<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
																	</svg>
																</button>
															@endif
														</div>
													</li>
												@endforeach
											</ol>
											<script>
												document.addEventListener('alpine:init', () => {
													Alpine.data('theses', () => ({
														deleteThesis(id, title, thesisId) {
															if (confirm(`Вы намерены отозвать тезисы ${thesisId}, ${title}. Отозвать и удалить?`)) {
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
