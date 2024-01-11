@extends('layouts.app')

@section('title', $conference->title_ru)

@section('content')
<main>
	{{ $conference->title_ru }}
</main>
@endsection
