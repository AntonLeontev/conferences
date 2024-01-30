@extends('pdf.layout')

@section('styles')
	<style>
		body {
			font-size: 12px;
		}
		.acronim {
			font-size: 14px;
			margin-bottom: 15px;
		}
		.title {
			font-size: 14px;
			margin-bottom: 10px;
		}
		.authors {
			margin-bottom: 10px;
		}
		.affiliations-list {
			margin-left: 0;
			padding-left: 0;
		}
		.affiliations-list li{
			margin-left: 0;
			list-style-type: none;
		}
		.email {
			margin-bottom: 20px;
		}
		.text {
			margin-top: 15px;
		}

		.text p {
			margin-top: 0px;
			margin-bottom: 10px;
			text-align: justify;
		}
	</style>
@endsection

@php
	$lang = $conference->abstracts_lang->value;	
	
	$affiliationsList = collect();
	foreach ($thesis->authors ?? [] as $author) {
		foreach ($author['affiliations'] ?? [] as $affiliation) {
			if ($affiliationsList->contains($affiliation['title_'.$lang])) {
				continue;
			}

			$affiliationsList->push($affiliation['title_'.$lang]);
		}
	}
@endphp

@section('content')
	<div class="acronim">
		<strong>
			{{ $thesis->thesis_id }}
		</strong>
	</div>
	<div class="title">
		<strong>{!! $thesis->title !!}</strong>
	</div>

	<div class="authors">
		@foreach ($thesis->authors as $key => $author)
			@php
				$authorAffiliationIndexes = [];
				foreach ($author['affiliations'] ?? [] as $affiliation) {
					if ($affiliationsList->contains($affiliation['title_'.$lang])) {
						$authorAffiliationIndexes[] = $affiliationsList->search(fn($val) => $val === $affiliation['title_'.$lang]) + 1;
					}
				}
			@endphp
			@if ($thesis->reporter['id'] == $key)
				<strong>
			@endif
				<span>
					{{ $author['name_'.$lang] }}@if (!empty($author['middle_name_'.$lang])) {{ mb_substr($author['middle_name_'.$lang], 0, 1) }}.@endif {{ $author['surname_'.$lang] }}<sup class="sup">{{ implode(',', $authorAffiliationIndexes) }}</sup>@if (!$loop->last),@endif
				</span>
			@if ($thesis->reporter['id'] == $key)
			</strong>
			@endif
		@endforeach
	</div>
	<ul class="affiliations-list">
		@foreach ($affiliationsList as $key => $affiliation)
			<li class=""><sup>{{ $key + 1 }}</sup>{{ $affiliation }}</li>
		@endforeach
	</ul>
	<div class="email">{{ $thesis->contact['email'] }}</div>
	<div class="text">{!! str($thesis->text)->replace('<br>', ' ') !!}</div>
@endsection