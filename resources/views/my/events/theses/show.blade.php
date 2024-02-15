@extends('layouts.app')

@section('title', $thesis->title)

@section('content')
    <main class="page page_edit _single-thesis">
        <section class="edit">
            <div class="edit__container">
                <div class="edit__wrapper">
                    <aside class="edit__aside aside">
                        <a href="{{ route('theses.index-by-conference', $conference->slug) }}"
                            class="aside__back _icon-arrow-back" data-da=".content-thesis__title, 767.98"></a>
                    </aside>
                    <div class="edit-content">
                        <nav class="edit-content__breadcrumbs breadcrumbs" data-da=".edit__wrapper, 767.98, first">
                            <ul class="breadcrumbs__list">
                                <li class="breadcrumbs__item">
                                    <a href="{{ route('events.organization-index') }}" class="breadcrumbs__link">
                                        <span>Организованные мероприятия</span>
                                    </a>
                                </li>
                                <li class="breadcrumbs__item">
                                    <a href="{{ route('conference.show', $conference->slug) }}" class="breadcrumbs__link">
                                        <span title="{{ $conference->title_ru }}">{{ $conference->title_ru }}</span>
                                    </a>
                                </li>
                                <li class="breadcrumbs__item">
                                    <a href="{{ route('theses.index-by-conference', $conference->slug) }}" class="breadcrumbs__link">
                                        <span>Список тезисов</span>
                                    </a>
                                </li>
                                <li class="breadcrumbs__item">
									<span class="breadcrumbs__current">{!! $thesis->title !!}</span>
                                </li>
                            </ul>
                        </nav>
                        <div class="thesis-single">
                            <div class="thesis-single__content content-thesis">
                                <h1 class="content-thesis__title">{!! $thesis->title !!}</h1>
                                <div class="content-thesis__header header-thesis">
                                    {{-- <img class="header-thesis__img" src="img/avatar/01.png" alt="Image"> --}}
                                    <div class="header-thesis__body">
                                        <div class="header-thesis__title">
                                            {{ $thesis->participation->fullname }}
                                        </div>
										@foreach ($thesis->participation->affiliations as $affiliation)
                                        	<div class="header-thesis__category">{{ $affiliation['title_'.loc()] }}</div>
										@endforeach
                                        <a href="mailto:{{ $thesis->participation->email }}" class="header-thesis__category">{{ $thesis->participation->email }}</a>
                                    </div>
                                </div>

								@php
									$lang = $conference->abstracts_lang->value;	
									
									$affiliationsList = collect();
									foreach ($thesis->authors ?? [] as $author) {
										foreach ($author['affiliations'] ?? [] as $affiliation) {
											if ($affiliationsList->contains(fn($value) => $affiliation['title_'.$lang] === $value['title_'.$lang])) {
												continue;
											}

											$affiliationsList->push($affiliation);
										}
									}
								@endphp

                                <div class="content-thesis__footnotes footnotes">
                                    <div class="footnotes__authors">
										@foreach ($thesis->authors as $key => $author)
											@php
												$authorAffiliationIndexes = [];
												foreach ($author['affiliations'] ?? [] as $affiliation) {
													if ($affiliationsList->contains(fn($value) => $affiliation['title_'.$lang] === $value['title_'.$lang])) {
														$index = $affiliationsList->search(fn($val) => $val['title_'.$lang] === $affiliation['title_'.$lang]);
														$authorAffiliationIndexes[] = $index + 1;
													}
												}
											@endphp
											<span class="footnotes__item @if(!$loop->first) -tw-ml-2 @endif @if($thesis->reporter['id'] == $key) _main @endif">
												{{ $author['name_'.$lang] }}@if (!empty($author['middle_name_'.$lang])) {{ mb_substr($author['middle_name_'.$lang], 0, 1) }}.@endif {{ $author['surname_'.$lang] }}<sup>{{ implode(',', $authorAffiliationIndexes) }}</sup>@if (!$loop->last), @endif
											</span>
										@endforeach
                                    </div>
                                    <div class="footnotes__organizations">
										@foreach ($affiliationsList as $key => $affiliation)
											<span class="footnotes__item">
												<sup>{{ $key + 1 }}</sup>
												{{ $affiliation['title_'.$lang] }}@if($affiliation['no_affiliation']), {{ $affiliation['country']["name_$lang"] }}@endif
											</span>
										@endforeach
                                    </div>
                                </div>

                                <div class="content-thesis__text">
                                    {!! $thesis->text !!}
                                </div>
                                <div class="content-thesis__date">
                                    Отправлено {{ $thesis->created_at->diffForHumans() }}
									(<span x-data x-text="DateTime.fromISO('{{ $thesis->created_at->toISOString() }}').toLocaleString(DateTime.DATE_MED)"></span>)
                                </div>
                            </div>
                            <div class="thesis-single__buttons">
                                <a href="{{ route('pdf.thesis.download', [$conference->slug, $thesis->id]) }}" download class="button">Скачать PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
