<aside class="edit__aside aside" data-spoilers="767.98">
    {{-- <div class="aside__title" data-spoiler>title</div> --}}
    <ul class="aside__list">
		@can('update', $conference)
			<li @if(Route::is('conference.edit')) class="active" @endif>
				<a href="{{ route('conference.edit', $conference->slug) }}">Редактирование мероприятия</a>
			</li>
		@endcan

		@can('viewAbstracts', $conference)
			<li @if(Route::is('theses.index-by-conference')) class="active" @endif>
				<a href="{{ route('theses.index-by-conference', $conference->slug) }}">Список тезисов</a>
			</li>
		@endcan

		@can('viewParticipations', $conference)
			<li @if(Route::is('conference.participations')) class="active" @endif>
				<a href="{{ route('conference.participations', $conference->slug) }}">Список участников</a>
			</li>
		@endcan
		
		@can('massSectionUpdate', $conference)
			<li @if(Route::is('sections.index')) class="active" @endif>
				<a href="{{ route('sections.index', $conference->slug) }}">Управление секциями</a>
			</li>
		@endcan
    </ul>
</aside>
