<aside class="edit__aside aside" data-spoilers="767.98">
    {{-- <div class="aside__title" data-spoiler>title</div> --}}
    <ul class="aside__list">
        <li @if(Route::is('conference.edit')) class="active" @endif>
            <a href="{{ route('conference.edit', $conference->slug) }}">Редактирование мероприятия</a>
        </li>
        <li @if(Route::is('theses.index-by-conference')) class="active" @endif>
            <a href="{{ route('theses.index-by-conference', $conference->slug) }}">Список тезисов</a>
        </li>
        <li @if(Route::is('conference.participations')) class="active" @endif>
            <a href="{{ route('conference.participations', $conference->slug) }}">Список участников</a>
        </li>
    </ul>
</aside>
