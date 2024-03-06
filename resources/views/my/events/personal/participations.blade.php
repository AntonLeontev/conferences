@extends('layouts.conference-lk')

@section('title', 'Участники конференции')

@section('content')
	@php
		$lang = $conference->abstracts_lang->value;
	@endphp
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
            <li class="breadcrumbs__item"><span class="breadcrumbs__current">Список участников</span>
            </li>
        </ul>
    </nav>
    <h1 class="edit-content__title">Список заявок на участие</h1>
    <div class="edit-content__items tw-min-h-[40vh]" 
		x-data="participations"
	>
		<template x-if="participations.length > 0">
			<table class="table" width="100%">
				<thead>
					<th>Имя</th>
					<th>Email</th>
					<th>Телефон</th>
					<th>ORCID</th>
					<th>Тип участия</th>
					<th>Дата подачи</th>
				</thead>
				<tbody>
					<template x-for="participation in participations">
						<tr>
							<td x-text="participation.surname_{{ $lang }} + ' ' + participation.name_{{ $lang }}"></td>
							<td x-text="participation.email"></td>
							<td x-text="participation.phone.clean"></td>
							<td>
								<template x-if="participation.orcid_id">
									<a class="tw-flex tw-items-center" :href="'https://orcid.org/' + participation.orcid_id" target="_blank" rel="nofollow">
										<img alt="ORCID logo" src="https://info.orcid.org/wp-content/uploads/2019/11/orcid_16x16.png" width="16" height="16" />
										<span class="tw-text-nowrap" x-text="participation.orcid_id"></span>
									</a>
								</template>
							</td>
							<td x-text="participation.participation_type"></td>
							<td>
								<time x-text="DateTime.fromISO(participation.created_at).toLocaleString()">май 1, 2023</time>
							</td>
						</tr>
					</template>
				</tbody>
			</table>
		</template>
		<template x-if="participations.length === 0">
			<div class="">Пока участников нет</div>
		</template>
        {{-- <div class="edit-content__more">
            <button class="button" type="button">Показать еще</button>
        </div> --}}
    </div>

	<script>
		document.addEventListener('alpine:init', () => {
			Alpine.data('participations', () => ({
				conference: @json($conference),
				participations: @json($conference->participations),
			}))
		})
	</script>
@endsection
