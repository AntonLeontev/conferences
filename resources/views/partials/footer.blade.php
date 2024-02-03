<footer class="footer">
	<div class="footer__container">
		<div class="tw-flex tw-justify-between">
			<div class="tw-flex tw-flex-col tw-gap-6">
				<a href="{{ route('home') }}" class="logo">
					<span>ucp</span>
					<span>Universal Conference Portal</span>
				</a>
				<a class="tw-text-[#fff]" href="/policy_ru.pdf" download>Политика конфиденциальности</a>
			</div>
			<form class="tw-flex tw-flex-col tw-min-w-96 tw-gap-3 tw-p-2"
				@submit.prevent="submit"
				x-data="{
					isSent: false,
					form: $form('post', '{{ route('feedback') }}', {
						name: '',
						email: '',
						message: '',
						user_id: '{{ auth()->id() }}',
						route_name: '{{ Route::currentRouteName() }}',
						page: '{{ url()->current() }}'
					}),

					submit() {
						if (this.isSent) return
						
						this.form.submit()
							.then(response => {
								this.isSent = true
							})
							.catch(err => {
								console.log(err)
							})
					},
				}"
			>
				<p class="tw-text-center tw-text-[#f8f5f2] tw-text-[18px]">Обратная связь</p>
				<input class="input tw-bg-[#f8f5f2]" autocomplete="off" type="text" name="name"
					placeholder="Имя*"
					x-model="form.name"
				>
				<template x-if="form.invalid('name')">
					<div class="form__error" x-text="form.errors.name"></div>
				</template>
				<input class="input tw-bg-[#f8f5f2]" autocomplete="off" type="email" name="email"
					placeholder="email*"
					x-model="form.email"
				>
				<template x-if="form.invalid('email')">
					<div class="form__error" x-text="form.errors.email"></div>
				</template>
				<textarea class="input tw-bg-[#f8f5f2]" autocomplete="off" name="message"
					placeholder="Сообщение*"
					x-model="form.message"
				></textarea>
				<template x-if="form.invalid('message')">
					<div class="form__error" x-text="form.errors.message"></div>
				</template>
				<button class="button button_primary" :disabled="form.processing" x-show="!isSent">Отправить</button>
				<p class="button button_primary" x-show="isSent">Сообщение отправлено</p>
			</form>
		</div>
	</div>
</footer>
