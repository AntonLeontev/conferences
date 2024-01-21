@extends('layouts.auth')

@section('title', 'Участие в мероприятии')

@section('h1', 'Заявка на участие в мероприятии')

@section('back_link', route('conference.show', $conference->slug))

@section('content')
	<script>
		let affiliations = @json(auth()->user()->participant->affiliations);
		if (affiliations.length === 0) affiliations = {} 
	</script>

    <form class="registration__form form" @submit.prevent="submit" x-data="{
        form: $form('post', '{{ route('participation.store', $conference->slug) }}', {
            conference_id: '{{ $conference->id }}',
            participant_id: '{{ auth()->user()->participant->id }}',
            name_ru: '{{ auth()->user()->participant->name_ru }}',
            surname_ru: '{{ auth()->user()->participant->surname_ru }}',
            middle_name_ru: '{{ auth()->user()->participant->middle_name_ru }}',
            name_en: '{{ auth()->user()->participant->name_en }}',
            surname_en: '{{ auth()->user()->participant->surname_en }}',
            middle_name_en: '{{ auth()->user()->participant->middle_name_en }}',
            phone: '{{ auth()->user()->participant->phone?->raw() }}',
			affiliations: affiliations,
            email: '{{ auth()->user()->email }}',
            orcid_id: '{{ auth()->user()->participant->orcid_id }}',
            website: '{{ auth()->user()->participant->website }}',
			participation_type: '',
			is_young: false,
        }),
    
        submit() {
            this.form.submit()
                .then(response => {
                    location.replace(response.data.redirect ?? '/')
                })
                .catch(error => {});
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

        <div class="form__row _three">
            <div class="form__line" :class="form.invalid('name_ru') && '_error'">
                <label class="form__label" for="u_5">@lang('auth.register.name_ru') (*)</label>
                <input id="u_5" class="input" autocomplete="off" type="text" name="name_ru" data-error="Ошибка"
                    placeholder="@lang('auth.register.name_ru')" x-model="form.name_ru"
                    @input.debounce.1000ms="form.validate('name_ru')">
            </div>
            <div class="form__line" :class="form.invalid('surname_ru') && '_error'">
                <label class="form__label" for="u_6">@lang('auth.register.surname_ru') (*)</label>
                <input id="u_6" class="input" autocomplete="off" type="text" name="surname_ru" data-error="Ошибка"
                    placeholder="@lang('auth.register.surname_ru')" x-model="form.surname_ru"
                    @input.debounce.1000ms="form.validate('surname_ru')">
            </div>
            <div class="form__line" :class="form.invalid('middle_name_ru') && '_error'">
                <label class="form__label" for="u_7">@lang('auth.register.middle_name_ru')</label>
                <input id="u_7" class="input" autocomplete="off" type="text" name="middle_name_ru"
                    data-error="Ошибка" placeholder="@lang('auth.register.middle_name_ru')" x-model="form.middle_name_ru"
                    @input.debounce.1000ms="form.validate('middle_name_ru')">
            </div>
        </div>
        <template x-if="form.invalid('name_ru')">
            <div class="form__error" x-text="form.errors.name_ru"></div>
        </template>
        <template x-if="form.invalid('surname_ru')">
            <div class="form__error" x-text="form.errors.surname_ru"></div>
        </template>
        <template x-if="form.invalid('middle_name_ru')">
            <div class="form__error" x-text="form.errors.middle_name_ru"></div>
        </template>
        <div class="form__row _three">
            <div class="form__line" :class="form.invalid('name_en') && '_error'">
                <label class="form__label" for="u_8">@lang('auth.register.name_en') (*)</label>
                <input id="u_8" class="input" autocomplete="off" type="text" name="name_en" data-error="Ошибка"
                    placeholder="@lang('auth.register.name_en')" x-model="form.name_en"
                    @input.debounce.1000ms="form.validate('name_en')">
            </div>
            <div class="form__line" :class="form.invalid('surname_en') && '_error'">
                <label class="form__label" for="u_9">@lang('auth.register.surname_en') (*)</label>
                <input id="u_9" class="input" autocomplete="off" type="text" name="surname_en" data-error="Ошибка"
                    placeholder="@lang('auth.register.surname_en')" x-model="form.surname_en"
                    @input.debounce.1000ms="form.validate('surname_en')">
            </div>
            <div class="form__line" :class="form.invalid('middle_name_en') && '_error'">
                <label class="form__label" for="u_10">@lang('auth.register.middle_name_en')</label>
                <input id="u_10" class="input" autocomplete="off" type="text" name="middle_name_en"
                    data-error="Ошибка" placeholder="@lang('auth.register.middle_name_en')" x-model="form.middle_name_en"
                    @input.debounce.1000ms="form.validate('middle_name_en')">
            </div>
        </div>
        <template x-if="form.invalid('name_en')">
            <div class="form__error" x-text="form.errors.name_en"></div>
        </template>
        <template x-if="form.invalid('surname_en')">
            <div class="form__error" x-text="form.errors.surname_en"></div>
        </template>
        <template x-if="form.invalid('middle_name_en')">
            <div class="form__error" x-text="form.errors.middle_name_en"></div>
        </template>

        <div id="affiliations" class="form__row" x-data="{
            ai: +Object.keys(affiliations).pop() + 1,
        
            add() {
                if (Object.keys(this.form.affiliations).length >= 5) return
                this.form.affiliations[this.ai] = {
                    id: '',
                    title_ru: '',
                    title_en: '',
                    has_mistake: false,
                    no_affiliation: false,
                }
                this.ai++
            },
            remove(id) {
                delete this.form.affiliations[id]
            },
			affiliationsIds() {
				let result = []
				Object.values(this.form.affiliations)
					.forEach(el => {
						if (el.id == '') return
						result.push(el.id)
					})
				return result
			},
        }">
            <label class="form__label" for="f_1">Аффилиации</label>
            <template x-for="affiliation, id in form.affiliations" x-key="id">
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
                        this.form.affiliations[id].id = suggestion.id
                        this.form.affiliations[id].title_ru = suggestion.title_ru
                        this.form.affiliations[id].title_en = suggestion.title_en
                        this.show = false
                    },
                    changeMistake() {
                        if (this.$el.checked) {
                            this.noAffiliation = false
                        } else {
                            this.form.affiliations[id].id = ''
                            this.form.affiliations[id].title_ru = ''
                            this.form.affiliations[id].title_en = ''
                        }
                        this.form.affiliations[id].has_mistake = this.$el.checked
                    },
                    changeNoAffiliation() {
                        if (this.$el.checked) {
                            this.hasMistake = false
                        }
                        this.form.affiliations[id].id = ''
                        this.form.affiliations[id].title_ru = ''
                        this.form.affiliations[id].title_en = ''
                        this.form.affiliations[id].no_affiliation = this.$el.checked
                    },
                }">
                    <div class="form__line" @click.outside="show = false">
                        <textarea autocomplete="off" name="form[]" placeholder="Введите вашу аффилиацию" class="input"
                            :class="form.invalid(`affiliations.${id}.title_ru`) && '_error'" x-model="form.affiliations[id].title_ru"
                            @input.debounce.500ms="getSuggestions"></textarea>
                        <template x-if="form.invalid(`affiliations.${id}.title_ru`)">
                            <div class="form__error" x-text="form.errors[`affiliations.${id}.title_ru`]"></div>
                        </template>
                        <div class="input-tips" x-show="show" x-transition.opacity>
                            <ul>
                                <template x-for="suggestion in suggestions">
                                    <li x-text="suggestion.title_ru" @click="select(suggestion, id)"></li>
                                </template>
                                <template x-if="suggestions.length === 0">
                                    <li>Ничего не найдено</li>
                                </template>
                            </ul>
                        </div>

                    </div>
                    <div class="form__line">
                        <textarea autocomplete="off" name="form[]" placeholder="Full name" class="input"
                            :class="form.invalid(`affiliations.${id}.title_en`) && '_error'" :disabled="!hasMistake && !noAffiliation"
                            x-model="form.affiliations[id].title_en"></textarea>
                        <template x-if="form.invalid(`affiliations.${id}.title_en`)">
                            <div class="form__error" x-text="form.errors[`affiliations.${id}.title_en`]"></div>
                        </template>
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
                                    :name="'handle' + id" x-model="noAffiliation" @change="changeNoAffiliation">
                                <label :for="'a_2' + id" class="checkbox__label">
                                    <span class="checkbox__text">Аффилиации нет в списке</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form__line">
                        <button class="form__button button button_outline" type="button" @click="remove(id)">
                            Убрать аффилиацию
                        </button>
                    </div>
                </div>
            </template>

            <div class="form__line">
                <button class="form__button button" type="button" @click="add">Добавить аффилиацию</button>
            </div>
        </div>

        <div class="form__row" :class="form.invalid('orcid_id') && '_error'">
            <label class="form__label" for="c_4">ORCID ID</label>
            <div class="form__line">
                <input id="c_4" class="input" autocomplete="off" type="text" name="orcid_id"
                    data-error="Ошибка" placeholder="ID" x-mask="9999-9999-9999-9999" x-model="form.orcid_id"
                    @input.debounce.1000ms="form.validate('orcid_id')">
            </div>
            <template x-if="form.invalid('orcid_id')">
                <div class="form__error" x-text="form.errors.orcid_id"></div>
            </template>
        </div>

        <div class="form__row" :class="form.invalid('website') && '_error'">
            <label class="form__label" for="c_5">Личный сайт</label>
            <div class="form__line">
                <input id="c_5" class="input" autocomplete="off" type="text" name="website"
                    data-error="Ошибка" placeholder="http://example.ru" x-model="form.website"
                    @input.debounce.1000ms="form.validate('website')">
            </div>
            <template x-if="form.invalid('website')">
                <div class="form__error" x-text="form.errors.website"></div>
            </template>
        </div>

		<div class="form__row" :class="form.invalid('phone') && '_error'">
            <label class="form__label" for="f_10">Контактный телефон</label>
            <input id="f_10" class="input" autocomplete="off" type="text"
                placeholder="Контактный телефон" x-model="form.phone"
				@input.debounce.1000ms="form.validate('phone')">
			<template x-if="form.invalid('phone')">
                <div class="form__error" x-text="form.errors.phone"></div>
            </template>
        </div>

        <div class="form__row">
            <label class="form__label">Тип участия</label>
            <div class="d-flex-start">
                <div class="checkbox">
                    <input id="s_1" class="checkbox__input" type="radio" checked value="speaker" name="participationType" 
						x-model="form.participation_type">
                    <label for="s_1" class="checkbox__label">
                        <span class="checkbox__text">Докладчик</span>
                    </label>
                </div>
                <div class="checkbox">
                    <input id="s_2" class="checkbox__input" type="radio" value="visitor" name="participationType"
						x-model="form.participation_type">
                    <label for="s_2" class="checkbox__label">
                        <span class="checkbox__text">Посетитель</span>
                    </label>
                </div>
                {{-- <div class="checkbox">
                    <input id="s_3" class="checkbox__input" type="checkbox" value="1" name="participationType">
                    <label for="s_3" class="checkbox__label">
                        <span class="checkbox__text">Invited</span>
                    </label>
                </div> --}}
            </div>
			<template x-if="form.invalid('participation_type')">
				<div class="form__error" x-text="form.errors.participation_type"></div>
			</template>
        </div>

        <div class="form__row">
            {{-- <label class="form__label">Role</label> --}}
            <div class="checkbox">
                <input id="r_1" class="checkbox__input" type="checkbox" x-model="form.is_young">
                <label for="r_1" class="checkbox__label">
                    <span class="checkbox__text">Молодой ученый до 35 лет</span>
                </label>
            </div>
        </div>

        <div class="form__row">
            {{-- <p>Вы можете заполнить форму тезисов позже самостоятельно через карточку мероприятия</p> --}}
            <div class="form__btns">
                <button class="form__button button button_primary" type="submit">Зарегистрироваться</button>
                {{-- <button class="form__button button" type="submit">Заполнить форму</button> --}}
            </div>
        </div>
    </form>
@endsection
