@extends('layouts.conference-lk')

@section('title', 'Список тезисов')

@section('content')
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
            <li class="breadcrumbs__item"><span class="breadcrumbs__current">Список тезисов</span>
            </li>
        </ul>
    </nav>
    <h1 class="edit-content__title">Список присланых тезисов</h1>
    <div class="edit-content__items tw-min-h-[40vh]" 
		x-data="theses"
	>
		<template x-if="theses.length > 0">
			<table class="table" width="100%">
				<thead>
					<th>Заголовок</th>
					<th>ID</th>
					<th>Дата</th>
					<th></th>
				</thead>
				<tbody>
					<template x-for="thesis in theses">
						<tr>
							<td>
								<a :href="`/my/events/${conference.slug}/abstracts/${thesis.id}`" x-html="thesis.title"></a>
							</td>
							<td x-text="thesis.thesis_id">
								1234
							</td>
							<td>
								<time x-text="DateTime.fromISO(thesis.created_at).toLocaleString()">май 1, 2023</time>
							</td>
							<td class="table__btn">
								<button type="button">
									<svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M9.1445 16.6737H10.492V13.1737H12.6445C13.0283 13.1737 13.3486 13.0454 13.6053 12.7887C13.8619 12.5321 13.9903 12.2112 13.9903 11.8263V9.67375C13.9903 9.28875 13.8619 8.96792 13.6053 8.71125C13.3486 8.45458 13.0278 8.32625 12.6427 8.32625H9.14275L9.1445 16.6737ZM10.492 11.8263V9.67375H12.6445V11.8263H10.492ZM15.8085 16.6737H19.1737C19.5564 16.6737 19.8767 16.5454 20.1345 16.2887C20.3912 16.0321 20.5195 15.7112 20.5195 15.3263V9.67375C20.5195 9.28875 20.3912 8.96792 20.1345 8.71125C19.8778 8.45458 19.557 8.32625 19.172 8.32625H15.8085V16.6737ZM17.1542 15.3263V9.67375H19.1737V15.3263H17.1542ZM22.6737 16.6737H24.0195V13.1737H26.4415V11.8263H24.0195V9.67375H26.4415V8.32625H22.6737V16.6737ZM8.20125 24.75C7.39625 24.75 6.72425 24.4805 6.18525 23.9415C5.64508 23.4013 5.375 22.7288 5.375 21.9237V3.07625C5.375 2.27125 5.64508 1.59925 6.18525 1.06025C6.72425 0.520083 7.39625 0.25 8.20125 0.25H27.0487C27.8538 0.25 28.5258 0.520083 29.0648 1.06025C29.6049 1.59925 29.875 2.27125 29.875 3.07625V21.9237C29.875 22.7288 29.6055 23.4013 29.0665 23.9415C28.5263 24.4805 27.8538 24.75 27.0487 24.75H8.20125ZM8.20125 23H27.0487C27.3171 23 27.5638 22.888 27.789 22.664C28.013 22.4388 28.125 22.1921 28.125 21.9237V3.07625C28.125 2.80792 28.013 2.56117 27.789 2.336C27.5638 2.112 27.3171 2 27.0487 2H8.20125C7.93292 2 7.68617 2.112 7.461 2.336C7.237 2.56117 7.125 2.80792 7.125 3.07625V21.9237C7.125 22.1921 7.237 22.4388 7.461 22.664C7.68617 22.888 7.93292 23 8.20125 23ZM2.95125 30C2.14625 30 1.47425 29.7305 0.93525 29.1915C0.395083 28.6513 0.125 27.9788 0.125 27.1737V6.57625H1.875V27.1737C1.875 27.4421 1.987 27.6888 2.211 27.914C2.43617 28.138 2.68292 28.25 2.95125 28.25H23.5487V30H2.95125Z"
											fill="#E25553" />
									</svg>
								</button>
							</td>
						</tr>
					</template>
				</tbody>
			</table>
		</template>
		<template x-if="theses.length === 0">
			<div class="">Тезисы еще никто не прислал</div>
		</template>
        {{-- <div class="edit-content__more">
            <button class="button" type="button">Показать еще</button>
        </div> --}}
    </div>

	<script>
		document.addEventListener('alpine:init', () => {
			Alpine.data('theses', () => ({
				conference: @json($conference),
				theses: @json($theses),
			}))
		})
	</script>
@endsection
