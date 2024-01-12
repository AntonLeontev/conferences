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
											<a href="{{ localize_route('conference.show', $conference->slug) }}">{{ $conference->{'title_'.loc()} }}</a>
										</div>
										<div class="list-result__details">
											<time>{{ $conference->start_date->translatedFormat('d M Y') }} - {{ $conference->end_date->translatedFormat('d M Y') }}</time>
											{{-- <strong>Институт теоретической физики Галилео Галилея, Флоренция, Италия</strong> --}}
										</div>
										<div class="list-result__body body-result">
											<div class="body-result__item">
												<strong>Организатор:</strong>
												<span> Институт Галилео Галилея</span>
											</div>
											<div class="body-result__text">
												<strong>Аннотация:</strong> {{ $conference->{'description_'.loc()} }}
											</div>
											<div class="body-result__item">
												<strong>Идентификатор события:</strong>
												<span>{{ $conference->id }}</span>
											</div>
											<div class="body-result__item">
												<strong>Связанные темы:</strong>
												@foreach ($conference->subjects as $subject)
													<span>
														<a href="{{ localize_route('subject', $subject->slug) }}">
															{{ $subject->{'title_'.loc()} }}
														</a>
													</span>
												@endforeach
											</div>
											@if ($conference->website)
												<div class="body-result__item">
													<strong>Сайт мероприятия:</strong>
													<span><a href="{{ $conference->website }}" target="_blank">{{ $conference->website }}</a></span>
												</div>
											@endif
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
