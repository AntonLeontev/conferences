@extends('layouts.conference-lk')

@section('title', 'Управление секциями')

@section('content')
	<script>
		let sections = @json($sections);
		let conference = @json($conference);
	</script>
	<div id="sections" 
		@refresh-moderators.window="refreshModerators"
		x-data="{
			conference: conference,
			form: $form('post', route('sections.mass-update', conference.slug), {
				sections: sections,
			}),
			
			save() {
				this.form.submit()
					.then(response => {
						this.form.sections = response.data
					})
					.catch(error => {
						alert('error')
					})
			},
			add() {
				this.form.sections.push({
					slug: 'acronim',
					title_ru: 'Название на русском',
					title_en: 'Titile in english',
					theses_exists: false,
				})
			},
			remove(id) {
				let section = this.form.sections[id]
				this.form.sections.splice(id, 1)

				if (section.id === undefined) {
					return
				}

				this.save()
			},
			addModerator(type, id) {
				this.$dispatch('popup', 'invite')
				this.$dispatch('add-moderator', {type, id})
			},
			refreshModerators() {
				if (this.$event.detail.type !== 'section') return
				
				let section = this.form.sections.find(el => el.id === this.$event.detail.id)
				section.moderators = this.$event.detail.moderators
			},
			removeModerator(type, moderableId, moderatorId) {
				axios
					.delete(route('moderators.destroy', this.conference.slug), {data: 
						{
							moderable_type: type,
							moderable_id: moderableId,
							user_id: moderatorId,
						}
					})
					.then(response => {
						this.$dispatch('refresh-moderators', {
							type: type,
							id: moderableId,
							moderators: response.data
						})
					}).catch(error => alert('error'))
			},
		}"
	>
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
				<li class="breadcrumbs__item"><span class="breadcrumbs__current">Управление секциями</span>
				</li>
			</ul>
		</nav>

		<h1 class="edit-content__title">Управление секциями</h1>
	
		<template x-if="sections.length > 0">
			<div class="accordion">
				<template x-for="(section, id) in form.sections" :key="id">
					<div class="accordion-item">
						<input :id="'accordion-trigger-' + (section.id ?? section.acronim)" class="accordion-trigger-input" type="checkbox">
						<label class="accordion-trigger" :for="'accordion-trigger-' + (section.id ?? section.acronim)" x-text="section.slug">
							Секциия_1
						</label>
						<div class="accordion-animation-wrapper">
							<div class="accordion-animation">
								<div class="accordion-transform-wrapper">
									<div class="accordion-content">
										<div class="form">
											<div class="form__line" :class="form.invalid(`sections.${id}.slug`) && '_error'">
												<input class="input" autocomplete="off" type="text" name="slug"
													placeholder="Акроним" x-model="form.sections[id].slug"
													@input="form.validate(`sections.${id}.slug`)">
												<template x-if="form.invalid(`sections.${id}.slug`)">
													<div class="form__error" x-text="form.errors[`sections.${id}.slug`]"></div>
												</template>

												<div class="tw-m-1">
													Это поле используется для генерации ID тезисов:
													<span x-text="`${conference.slug}-${form.sections[id].slug}001`"></span>
												</div>
											</div>
											<div class="form__line" :class="form.invalid(`sections.${id}.title_ru`) && '_error'">
												<input class="input" autocomplete="off" type="text" name="title_ru"
													placeholder="Название" x-model="form.sections[id].title_ru"
													@input="form.validate(`sections.${id}.title_ru`)">
												<template x-if="form.invalid(`sections.${id}.title_ru`)">
													<div class="form__error" x-text="form.errors[`sections.${id}.title_ru`]"></div>
												</template>
											</div>
											<div class="form__line" :class="form.invalid(`sections.${id}.title_en`) && '_error'">
												<input class="input" autocomplete="off" type="text" name="title_en"
													placeholder="Title" x-model="form.sections[id].title_en"
													@input="form.validate(`sections.${id}.title_en`)">
												<template x-if="form.invalid(`sections.${id}.title_en`)">
													<div class="form__error" x-text="form.errors[`sections.${id}.title_en`]"></div>
												</template>
											</div>
										</div>
			
										<div class="moderators">
											<div class="moderators__title">
												Модераторы
											</div>
											<template x-if="section.moderators.length === 0">
												<div>Модераторы не приглашены</div>
											</template>
											<ol>
												<template x-for="(moderator, moderatorId) in section.moderators">
													<li>
														<div class="moderators__item">
															<div>
																<span x-text="moderator.email"></span>
																<span x-show="moderator.pivot.comment"> - </span>
																<span x-text="moderator.pivot.comment"></span>
															</div>
															<button 
																class="_icon-close" 
																type="button" 
																@click="removeModerator('section', section.id, moderator.id)"
															></button>
														</div>
													</li>
												</template>
											</ol>
										</div>
										<div class="section-actions">
											<div class="section-actions__item">
												<template x-if="section.id">
													<button class="section-actions__btn button button_icon" type="button">
														<img src="{{ Vite::asset('resources/img/iconsfonts/invite.svg') }}" alt="Image">
														<span @click="addModerator('section', section.id)">Пригласить</span>
													</button>
												</template>
											</div>
											<div class="section-actions__item">
												<button 
													class="section-actions__btn button button_outline" 
													@click="save"
													:disabled="form.processing"
												>
													Сохранить
												</button>
												<template x-if="!section.theses_exists">
													<button 
														class="section-actions__btn button button_primary"
														@click="remove(id)"
														:disabled="form.processing"
													>
														Удалить
													</button>
												</template>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</template>
			</div>
		</template>
		<template x-if="sections.length == 0">
			<div class="">Секции не созданы</div>
		</template>
	
		<button class="button button_outline tw-mt-3" type="button" @click="add">Добавить секцию</button>
	</div>
@endsection

@section('popup')
	<x-popup id="invite" title="Пригласить модератора">
		<form class="form" id="invite-moderator"
			x-data="{
				form: $form('post', route('moderators.store', conference.slug), {
					moderable_type: null,
					moderable_id: null,
					email: '',
					comment: '',
				}),

				add() {
					this.form.moderable_type = this.$event.detail.type
					this.form.moderable_id = this.$event.detail.id
				},
				submit() {
					this.form.submit()
						.then(response => {
							this.$dispatch('refresh-moderators', {
								type: this.form.moderable_type,
								id: this.form.moderable_id,
								moderators: response.data
							})
						})
						.catch(error => {
							alert('Ошибка')
						})
				},
			}"
			@add-moderator.window="add"
			@submit.prevent="submit"
		>
			<div class="form__line">
				<input class="input" autocomplete="off" type="email" placeholder="Адрес электронной почты" x-model="form.email">
			</div>
			<div class="form__line">
				<input class="input" autocomplete="off" type="text" placeholder="Комментарий" x-model="form.comment">
			</div>
			<div class="form__line">
				<button class="popup__btn button" type="submit">Пригласить</button>
			</div>
		</form>
	</x-popup>
@endsection
