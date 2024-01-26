@extends('layouts.auth')

@section('title', 'Подача тезисов')

@section('h1', 'Подача тезисов')

@section('back_link', route('conference.show', $conference->slug))

@section('head_scripts')
	@vite(['resources/js/wysiwyg.js'])
@endsection

@php
	$lang = $conference->abstracts_lang->value;
@endphp

@section('content')
    <script>
        let affiliations = @json($participation->affiliations);
        if (affiliations.length === 0) affiliations = {}
    </script>

    <form class="registration__form form" 
	@select-callback.camel.document="select"
	@submit.prevent="submit" 
	x-data="{
        form: $form('post', '{{ route('theses.store', $conference->slug) }}', {
            participation_id: '{{ $participation->id }}',
			@if ($conference->sections->isNotEmpty())
				section_id: null,
			@endif
            report_form: 'oral',
            title: '',
            authors: {
                1: {
					@if ($lang === 'ru')
						name_ru: '{{ $participation->name_ru }}',
						surname_ru: '{{ $participation->surname_ru }}',
						middle_name_ru: '{{ $participation->middle_name_ru }}',
					@endif
					@if ($lang === 'en')
						name_en: '{{ $participation->name_en }}',
						surname_en: '{{ $participation->surname_en }}',
						middle_name_en: '{{ $participation->middle_name_en }}',
					@endif
                    affiliations: affiliations,
                }
            },
			reporter: {
				id: 1,
				is_young: false,
			},
			contact: {
				id: 1,
				email: '{{ $participation->email }}'
			},
			text: '',
        }),

		init() {
			setTimeout(() => {
				document.querySelectorAll('select')
					.forEach(select => this.getSelectValue(select))
			}, 2000)
		},
        submit() {
			this.getEditorsData()

            this.form.submit()
                .then(response => {
                    location.replace(response.data.redirect ?? '/')
                })
                .catch(error => {});
        },
		select() {
			let select = this.$event.detail.select
			this.getSelectValue(select)
		},
		getSelectValue(select) {
			if (select.dataset.name == 'section_id') {
				this.form.section_id = select.value
			} else if (select.dataset.name == 'report_form') {
				this.form.report_form = select.value
			} else if (select.dataset.name == 'reporter') {
				this.form.reporter.id = select.value
			} else if (select.dataset.name == 'contact') {
				this.form.contact.id = select.value
			}
		},
		postpone(ready, make) {
			if (ready()) {
				make()
				return
			}

			setTimeout(() => this.postpone(ready, make), 500);
		},
		getEditorsData() {
			this.form.title = editorTitle.getData()
			this.form.text = editorText.getData()
		},
    }">
        <div class="form__row">
            <h2 class="form__title">{{ $conference->{'title_' . loc()} }}</h2>
            <div class="time-block">
                <time>{{ $conference->start_date->translatedFormat('d M Y') }}
                    -
                    {{ $conference->end_date->translatedFormat('d M Y') }}
                </time>

                @empty($conference->organization->{'short_name_' . loc()})
                    <span>{{ $conference->organization->{'full_name_' . loc()} }}</span>
                @else
                    <span>{{ $conference->organization->{'short_name_' . loc()} }}</span>
                @endempty
            </div>
        </div>

        @if ($conference->sections->count() > 0)
            <div class="form__row">
                <label class="form__label">Выберите секцию (*)</label>
                <select name="section_id" data-scroll="500" data-class-modif="form" data-name="section_id">
                    <option value="" selected>Выберите секцию</option>
                    @foreach ($conference->sections as $section)
                        <option value="{{ $section->id }}">{{ $section->{'title_' . loc()} }}</option>
                    @endforeach
                </select>
				<template x-if="form.invalid(`section_id`)">
					<div class="form__error" x-text="form.errors[`section_id`]"></div>
				</template>
            </div>
        @endif

        <div class="form__row">
            <label class="form__label">Форма доклада (*)</label>
            <select name="report_form" data-scroll="500" data-class-modif="form" data-name="report_form">
                <option value="oral" selected>Устная</option>
                <option value="stand">Стендовые доклады</option>
                <option value="mixed">Смешанная</option>
            </select>
        </div>

        <label class="form__label _mb0">Список авторов (*) </label>

		<div x-data="{
			ai: null,
			selectClass: null,

			init() {
				this.ai = +Object.keys(this.form.authors).pop() + 1

				this.postpone(this.checkModules, this.saveSelects)
			},
			postpone() {
				setTimeout(() => {
					if (typeof modules_flsModules == 'undefined') {
						this.postpone()
						return;
					}
					
					this.selectClass = modules_flsModules.select
				}, 500)
			},
			add() {
                this.form.authors[this.ai] = {
					@if ($lang === 'ru')
						name_ru: '',
						surname_ru: '',
						middle_name_ru: '',
					@endif
					@if ($lang === 'en')
						name_en: '',
						surname_en: '',
						middle_name_en: '',
					@endif
                    affiliations: {},
                }
                this.ai++
            },
            remove(id) {
                delete this.form.authors[id]
            },
			updateSelects() {
				this.selectClass.updateSelect(document.querySelector('#reporter'))
				this.selectClass.updateSelect(document.querySelector('#contact'))
			},
			inputName(id) {
				this.updateSelects()

				this.form.validate(`authors.${id}.name_{{ $lang }}`)
			},
			inputSurname(id) {
				this.updateSelects()

				this.form.validate(`authors.${id}.surname_{{ $lang }}`)
			},
			removeAuthor(id) {
				this.remove(id)

				this.$nextTick(() => {
					this.updateSelects()
				})
			}
		}">
			<template x-for="author, id in form.authors" x-key="id">
				<div class="author">
					@if ($lang === 'ru')
						<div class="form__row _three">
							<div class="form__line" :class="form.invalid(`authors.${id}.name_ru`) && '_error'">
								<label class="form__label" for="u_5">@lang('auth.register.name_ru') (*)</label>
								<input id="u_5" class="input" autocomplete="off" type="text" name="name_ru"
									data-error="Ошибка" placeholder="@lang('auth.register.name_ru')" x-model="form.authors[id].name_ru"
									@input.debounce.500ms="inputName(id)">
							</div>
							<div class="form__line" :class="form.invalid(`authors.${id}.surname_ru`) && '_error'">
								<label class="form__label" for="u_6">@lang('auth.register.surname_ru') (*)</label>
								<input id="u_6" class="input" autocomplete="off" type="text" name="surname_ru"
									data-error="Ошибка" placeholder="@lang('auth.register.surname_ru')" x-model="form.authors[id].surname_ru"
									@input.debounce.500ms="inputSurname(id)">
							</div>
							<div class="form__line" :class="form.invalid(`authors.${id}.middle_name_ru`) && '_error'">
								<label class="form__label" for="u_7">@lang('auth.register.middle_name_ru')</label>
								<input id="u_7" class="input" autocomplete="off" type="text" name="middle_name_ru"
									data-error="Ошибка" placeholder="@lang('auth.register.middle_name_ru')" x-model="form.authors[id].middle_name_ru"
									@input.debounce.1000ms="form.validate(`authors.${id}.middle_name_ru`)">
							</div>
						</div>
						<template x-if="form.invalid(`authors.${id}.name_ru`)">
							<div class="form__error" x-text="form.errors[`authors.${id}.name_ru`]"></div>
						</template>
						<template x-if="form.invalid(`authors.${id}.surname_ru`)">
							<div class="form__error" x-text="form.errors[`authors.${id}.surname_ru`]"></div>
						</template>
						<template x-if="form.invalid(`authors.${id}.middle_name_ru`)">
							<div class="form__error" x-text="form.errors[`authors.${id}.middle_name_ru`]"></div>
						</template>
					@endif
						
					@if ($lang === 'en')
						<div class="form__row _three">
							<div class="form__line" :class="form.invalid(`authors.${id}.name_en`) && '_error'">
								<label class="form__label" for="u_8">@lang('auth.register.name_en') (*)</label>
								<input id="u_8" class="input" autocomplete="off" type="text" name="name_en"
									data-error="Ошибка" placeholder="@lang('auth.register.name_en')" x-model="form.authors[id].name_en"
									@input.debounce.500ms="inputName(id)">
							</div>
							<div class="form__line" :class="form.invalid(`authors.${id}.surname_en`) && '_error'">
								<label class="form__label" for="u_9">@lang('auth.register.surname_en') (*)</label>
								<input id="u_9" class="input" autocomplete="off" type="text" name="surname_en"
									data-error="Ошибка" placeholder="@lang('auth.register.surname_en')" x-model="form.authors[id].surname_en"
									@input.debounce.500ms="inputSurname(id)">
							</div>
							<div class="form__line" :class="form.invalid(`authors.${id}.middle_name_en`) && '_error'">
								<label class="form__label" for="u_10">@lang('auth.register.middle_name_en')</label>
								<input id="u_10" class="input" autocomplete="off" type="text" name="middle_name_en"
									data-error="Ошибка" placeholder="@lang('auth.register.middle_name_en')"
									x-model="form.authors[id].middle_name_en"
									@input.debounce.1000ms="form.validate(`authors.${id}.middle_name_en`)">
							</div>
						</div>
						<template x-if="form.invalid(`authors.${id}.name_en`)">
							<div class="form__error" x-text="form.errors[`authors.${id}.name_en`]"></div>
						</template>
						<template x-if="form.invalid(`authors.${id}.surname_en`)">
							<div class="form__error" x-text="form.errors[`authors.${id}.surname_en`]"></div>
						</template>
						<template x-if="form.invalid(`authors.${id}.middle_name_en`)">
							<div class="form__error" x-text="form.errors[`authors.${id}.middle_name_en`]"></div>
						</template>
					@endif
	
					<div class="form__row">
						<div id="affiliations" class="form__row" x-data="{
							ai: Object.keys(author.affiliations).length > 0 ? +Object.keys(author.affiliations).pop() + 1 : 1,
						
							add() {
								if (Object.keys(author.affiliations).length >= 5) return
								author.affiliations[this.ai] = {
									id: '',
									title_ru: '',
									title_en: '',
									has_mistake: false,
									no_affiliation: false,
								}
								this.ai++
							},
							remove(id) {
								delete author.affiliations[id]
							},
							affiliationsIds() {
								let result = []
								Object.values(author.affiliations)
									.forEach(el => {
										if (el.id == '') return
										result.push(el.id)
									})
								return result
							},
						}">
							<label class="form__label" for="f_1">Аффилиации</label>
							<template x-for="affiliation, id in author.affiliations" x-key="id">
								<div class="affiliation form__line" x-data="{
									suggestions: [],
									show: false,
									hasMistake: false,
									noAffiliation: false,
								
									getSuggestions() {
										if (this.$el.value.trim() === '') return
								
										axios
											.get('{{ route('affiliations.index') }}', {
												params: {
													search: this.$el.value,
													except: this.affiliationsIds()
												}
											})
											.then(resp => {
												this.suggestions = resp.data
												this.show = true
											})
									},
									select(suggestion, id) {
										author.affiliations[id].id = suggestion.id
										author.affiliations[id].title_ru = suggestion.title_ru
										author.affiliations[id].title_en = suggestion.title_en
										this.show = false
									},
									changeMistake() {
										if (this.$el.checked) {
											this.noAffiliation = false
										} else {
											author.affiliations[id].id = ''
											author.affiliations[id].title_ru = ''
											author.affiliations[id].title_en = ''
										}
										author.affiliations[id].has_mistake = this.$el.checked
									},
									changeNoAffiliation() {
										if (this.$el.checked) {
											this.hasMistake = false
										}
										author.affiliations[id].id = ''
										author.affiliations[id].title_ru = ''
										author.affiliations[id].title_en = ''
										author.affiliations[id].no_affiliation = this.$el.checked
									},
								}">
									<div class="form__line" @click.outside="show = false">
										<textarea autocomplete="off" name="form[]" placeholder="Введите вашу аффилиацию" class="input"
											:class="form.invalid(`affiliations.${id}.title_{{ $lang }}`) && '_error'" x-model="author.affiliations[id].title_{{ $lang }}"
											@input.debounce.500ms="getSuggestions"></textarea>
										<template x-if="form.invalid(`affiliations.${id}.title_{{ $lang }}`)">
											<div class="form__error" x-text="form.errors[`affiliations.${id}.title_{{ $lang }}`]">
											</div>
										</template>
										<div class="input-tips" x-show="show" x-transition.opacity>
											<ul>
												<template x-for="suggestion in suggestions">
													<li x-text="suggestion.title_{{ $lang }}" @click="select(suggestion, id)"></li>
												</template>
												<template x-if="suggestions.length === 0">
													<li>Ничего не найдено</li>
												</template>
											</ul>
										</div>
	
									</div>
	
									<div class="form__line">
										<div class="checkbox-items">
											<div class="checkbox">
												<input :id="'a_1' + id" class="checkbox__input" type="checkbox"
													:name="'handle' + id" x-model="hasMistake" @change="changeMistake">
												<label :for="'a_1' + id" class="checkbox__label">
													<span class="checkbox__text">Аффилиация имеет ошибку в написании</span>
												</label>
											</div>
											<div class="checkbox">
												<input :id="'a_2' + id" class="checkbox__input" type="checkbox"
													:name="'handle' + id" x-model="noAffiliation"
													@change="changeNoAffiliation">
												<label :for="'a_2' + id" class="checkbox__label">
													<span class="checkbox__text">Аффилиации нет в списке</span>
												</label>
											</div>
										</div>
									</div>
									<div class="form__line">
										<button class="form__button button button_outline" type="button"
											@click="remove(id)">
											Убрать аффилиацию
										</button>
									</div>
								</div>
							</template>
	
							<div class="form__line">
								<button class="form__button button" type="button" @click="add">Добавить
									аффилиацию</button>
							</div>
						</div>
					</div>
	
					<div class="form__row">
						<button class="form__button button button_outline" type="button" @click="removeAuthor(id)">Убрать автора</button>
					</div>
	
				</div>
			</template>
			<div class="form__row" style="margin-top: 10px">
				<button class="form__button button" type="button" @click="add()">Добавить автора</button>
			</div>
		</div>


        <div class="form__row" id="reporter">
            <label class="form__label">Докладчик (*)</label>
            <select name="form[]" data-scroll="500" data-class-modif="form" data-name="reporter">
                <template x-for="author, key in form.authors" x-key="key"> 
					<option :value="key" x-text="`${author.name_{{ $lang }}} ${author.surname_{{ $lang }}}`"></option>
				</template>
            </select>

            <div class="checkbox">
                <input id="d_1" class="checkbox__input" type="checkbox" x-model="form.reporter.is_young">
                <label for="d_1" class="checkbox__label">
                    <span class="checkbox__text">Молодой ученый до 35 лет</span>
                </label>
            </div>
        </div>

        <div class="form__row" id="contact">
            <label class="form__label">Контакт для связи (*)</label>
            <select name="form[]" data-scroll="500" data-class-modif="form" data-name="contact">
				<template x-for="author, key in form.authors" x-key="key">
					<option :value="key" x-text="`${author.name_{{ $lang }}} ${author.surname_{{ $lang }}}`"></option>
				</template>
            </select>
        </div>

        <div class="form__row">
            <label class="form__label" for="c_1">E-mail для связи (*)</label>
            <input id="c_1" class="input" autocomplete="off" type="text" name="form[]"
                placeholder="Enter e-mail address"  x-model="form.contact.email">
        </div>

		@php
			if ($lang === 'en') {
				$titlePlaceholder = 'Заголовок на английском языке';
				$textPlaceholder = 'Текст на английском языке';
			}
			if ($lang === 'ru') {
				$titlePlaceholder = 'Заголовок на русском языке';
				$textPlaceholder = 'Текст на русском языке';
			}
		@endphp

		<div class="form__row editor-title" :class="form.invalid('title') && '_error'" x-data="{
			init() {
				let check = () => typeof ClassicEditor !== 'undefined'
				let make = () => {
					ClassicEditor
					.create(document.querySelector( '#editor-title' ), TitleEditorSettings)
					.then(editor => {
						editor.editing.view.document.getRoot( 'main' ).placeholder = '{{ $titlePlaceholder }}'
						window.editorTitle = editor
					})
					.catch( error => {
						console.error( error );
					} );
				}
				this.postpone(check, make)
			},
		}">
            <label class="form__label" for="n_1">Название доклада (*)</label>
			<style>
				.editor-title .ck-content {
					height: 40px;
				}
			</style>
			<div id="editor-title"></div>
            <template x-if="form.invalid('title')">
                <div class="form__error" x-text="form.errors.title"></div>
            </template>
        </div>

        <div class="form__row" 
		@text-editor-update.document="textUpdate"
		x-data="{
			textCount: 0,

			init() {
				let check = () => typeof ClassicEditor !== 'undefined'
				let make = () => {
					ClassicEditor
					.create(document.querySelector( '#editor-text' ), TextEditorSettings)
					.then(editor => {
						editor.editing.view.document.getRoot( 'main' ).placeholder = '{{ $textPlaceholder }}'
						window.editorText = editor
					})
					.catch( error => {
						console.error( error );
					} );
				}
				this.postpone(check, make)
		},
			textUpdate() {
				this.textCount = this.$event.detail.characters
			},
		}">
            <label class="form__label" for="t_1">Текст доклада (*)</label>
			<div class="form__line">
				<style>
					.ck-content {
						height: 300px;
					}
				</style>
				<div id="editor-text"></div>
			</div>
			<div class="form__line">
				Символов:
				<span id="characters" x-text="textCount"></span>
				<span>/</span>
				<span>{{ $conference->max_thesis_characters }}</span>
			</div>
			<div class="form__line">
				<template x-if="form.invalid('text')">
					<div class="form__error" x-text="form.errors.text"></div>
				</template>
			</div>
        </div>

        <div class="form__row">
            <div class="form__btns">
                <button 
					class="form__button button button_primary" 
					type="button"
					@click="getPdf"
					x-data="{
						async getPdf() {
							this.getEditorsData()

							form.touch(['section_id', 'title', 'text']).validate();

							if (this.form.title === '' || this.form.text === '') {
								return
							}

							if ((typeof this.form.section_id !== 'undefined') && this.form.section_id == null) {
								return
							}

							axios
								.post(
									'{{ route('pdf.thesis.preview', $conference->slug) }}',
									this.form,
									{responseType: 'blob'}
								)
								.then(res => {
									console.log(res.data)
									let blob = new Blob([res.data], {
										type: 'application/pdf',
									});
									
									let downloadLink = document.createElement('a');
									downloadLink.target = '_blank';
									downloadLink.download = 'abstracts preview.pdf';

									let URL = window.URL || window.webkitURL;
									let downloadUrl = URL.createObjectURL(blob);

									downloadLink.href = downloadUrl;

									document.body.append(downloadLink);

									downloadLink.click();
									downloadLink.remove();
								})
						}
					}"
				>Предпросмотр</button>
            </div>
        </div>
        <div class="form__row">
            <div class="form__btns">
                <button class="form__button button button_primary" type="submit">Отправить тезисы</button>
            </div>
        </div>

		<div class="form__row">
			<template x-if="form.hasErrors">
				<div class="form__error">В форме есть ошибки</div>
			</template>
		</div>

    </form>
@endsection
