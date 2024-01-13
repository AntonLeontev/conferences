@extends('layouts.auth')

@section('title', 'Подтверждение электронной почты')

@section('h1', 'Подтверждение электронной почты')

@section('content')
	<div class="form__row">
		Для полного доступа к функционалу, нужно подтвердить электронную почту, перейдя по ссылке в письме.
	</div>
	<form method="POST" action="/email/verification-notification">
		@csrf
		<button class="button">Выслать письмо повторно</button>
	</form>

	@if (session('status') == 'verification-link-sent')
		<style>
			.session-notification {
				display: flex;
				align-items: center;
				justify-content: space-between;
				margin-top: 20px;
				padding: 20px;
				background-color: var(--bg-accent);
				color: #fff;
			}
		</style>
		<div class="session-notification" x-data="{show: true}" x-show="show" x-transition>
			Новая ссылка отправлена на почту
			<button @click="show=false">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20px" height="20px">
					<path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
				</svg>
			</button>
		</div>
	@endif
@endsection
