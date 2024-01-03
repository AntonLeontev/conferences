@extends('layouts.app')

@section('title', $subject)

@section('content')
	<main class="page">
        <div class="section-divider white-block">
            <div class="white-block__container">
                <div class="white-block__inner">
                    <nav class="white-block__breadcrumbs breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__item"><a href="" class="breadcrumbs__link">Конференция</a></li>
                            <li class="breadcrumbs__item"><span class="breadcrumbs__current">{{ $subject }}</span>
                            </li>
                        </ul>
                    </nav>
                    <div class="white-block__title title-accent">
                        На этой странице:
                    </div>
                    <div class="tags">
                        <a href="">
                            Фундаментальные исследования</a>
                        <a href="">Математические методы</a>
                        <a href="">Физика конденсированного состояния</a>
                        <a href="">Приборы и технологии</a>
                        <a href="">Прикладная физика</a>
                        <a href="">Вспомогательный</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="subject-result page-divider">
            <div class="subject-result__container">
                <div class="subject-result__items">
                    <div class="subject-result__item">
                        <h2 class="subject-result__title title-bg">
                            Фундаментальные исследования
                        </h2>
                        <ol class="subject-result__list list-result">
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href="{{ route('single', ['subject' => 'Математика', 'single' => 'Астрономия, астрофизика и космология']) }}">Астрономия, астрофизика и космология (<span>86</span>)</a>
                                </div>
                                <div class="list-result__countries countries">
                                    <a href="{{ route('country', ['subject' => 'Математика', 'single' => 'Астрономия, астрофизика и космология', 'country' => 'Аргентина']) }}">Аргентина (<span>1</span>)</a>
                                    <a href="{{ route('country', ['subject' => 'Математика', 'single' => 'Астрономия, астрофизика и космология', 'country' => 'Армения']) }}">Армения (<span>3</span>)</a>
                                    <a href="{{ route('country', ['subject' => 'Математика', 'single' => 'Астрономия, астрофизика и космология', 'country' => 'Австрия']) }}">Австрия (<span>3</span>)</a>
                                </div>
                            </li>
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href="">Физика высоких энергий (<span>86</span>)</a>
                                </div>
                                <div class="list-result__countries countries">
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                </div>
                            </li>
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href=""> Атомный (<span>86</span>)</a>
                                </div>
                                <div class="list-result__countries countries">
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <div class="subject-result__item">
                        <h2 class="subject-result__title title-bg">
                            Математические методы
                        </h2>
                        <ol class="subject-result__list list-result">
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href="{{ route('subject', ['subject' => 'Математика', 'single' => 'test']) }}">Астрономия, астрофизика и космология (<span>86</span>)</a>
                                </div>
                                <div class="list-result__countries countries">
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                </div>
                            </li>
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href="">Физика высоких энергий (<span>86</span>)</a>
                                </div>
                                <div class="list-result__countries countries">
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                </div>
                            </li>
                            <li class="list-result__item">
                                <div class="list-result__title">
                                    <a href=""> Атомный (<span>86</span>)</a>
                                </div>
                                <div class="list-result__countries countries">
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                    <a href="">Аргентина (<span>1</span>)</a>
                                    <a href="">Армения (<span>3</span>)</a>
                                    <a href="">Австрия (<span>3</span>)</a>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
