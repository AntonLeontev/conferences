<header class="header">
    <div class="header__top">
        <div class="header__container">
            <a href="/" class="logo">
                <span>ucp</span>
                <span>Universal Conference Portal</span>
            </a>
            <div class="header__action">
                <div class="lang">
                    <button class="lang__btn _icon-arrow" type="button">{{ app()->getLocale() }}</button>
                    <ul class="lang__submenu submenu">
						@foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
							@if (app()->getLocale() !== $localeCode)
								<li class="submenu__item">
									<a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="submenu__link">{{ $localeCode }}</a>
								</li>
							@endif
						@endforeach
                    </ul>
                </div>
                
				@auth
					<div class="header__btns">
						{{-- <div class="header__link header__link_notification">
							<span></span>
							<img src="{{ Vite::asset('resources/img/notification.svg') }}" alt="Image">
							<div class="submenu-user">
								<div class="submenu-user__header">
									<strong>Ваши уведомления</strong>
								</div>
								<div class="submenu-user__body">
									<ul class="messages">
										<li class="message">
											<a class="stretched-link" href=""></a>
											<div class="message__inner">
												<img src="img/user.jpg" alt="Image">
												<div class="message__body">
													<div class="message__header">
														<strong>IEEE</strong>
														<div class="circle"></div>
													</div>
													<div class="message__text">
														Приглашение на участие в конференции Приглашение на участие в конференции
													</div>
												</div>
											</div>
										</li>
										<li class="message">
											<a class="stretched-link" href=""></a>
											<div class="message__inner">
												<img src="img/user.jpg" alt="Image">
												<div class="message__body">
													<div class="message__header">
														<strong>IEEE</strong>
														<div class="circle"></div>
													</div>
													<div class="message__text">
														Приглашение на участие в конференции
													</div>
												</div>
											</div>
										</li>
										<li class="message">
											<a class="stretched-link" href=""></a>
											<div class="message__inner">
												<img src="img/user.jpg" alt="Image">
												<div class="message__body">
													<div class="message__header">
														<strong>IEEE</strong>
														<div class="circle circle_read"></div>
													</div>
													<div class="message__text">
														Приглашение на участие в конференции
													</div>
												</div>
											</div>
										</li>
										<li class="message">
											<a class="stretched-link" href=""></a>
											<div class="message__inner">
												<img src="img/user.jpg" alt="Image">
												<div class="message__body">
													<div class="message__header">
														<strong>IEEE</strong>
														<div class="circle circle_read"></div>
													</div>
													<div class="message__text">
														Приглашение на участие в конференции
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div> --}}
						<div class="header__link header__link_user">
							<img class="img-user" src="{{ Vite::asset('resources/img/user.jpg') }}" alt="Image">
							<span>{{ auth()->user()->email }}</span>
							<div class="submenu-user">
								<div class="submenu-user__header">
									<div class="submenu-user__icon">
										<img src="{{ Vite::asset('resources/img/user.jpg') }}" alt="Image">
									</div>
									<strong @unless(auth()->user()->email_verified_at) class="red" @endunless>{{ auth()->user()->email }}</strong>
								</div>
								<div class="submenu-user__body">
									@if (auth()->user()->email_verified_at)
										<div class="submenu-user__item">
											@if (auth()->user()->participant()->exists())
												<ul class="submenu-user__list">
													@if (Route::has('participant.edit'))
														<li><a class="submenu-user__link" href="{{ route('participant.edit') }}">Мои данные</a></li>
													@endif
												</ul>
											@else
												<a href="{{ route('participant.create') }}" class="button button_outline">Регистрация участника</a>
											@endif
										</div>
										<div class="submenu-user__item">
											@if (auth()->user()->organization()->exists())
												<ul class="submenu-user__list">
													@if (Route::has('conference.create'))
														<li>
															<a class="submenu-user__link" href="{{ localize_route('conference.create') }}">
																Создать мероприятие
															</a>
														</li>
													@endif
												</ul>
											@else
												<a href="{{ route('organization.create') }}" class="button button_outline">Регистрация организации</a>
											@endif
										</div>
									@else
										<div class="submenu-user__item text-center">
											<div class="text-accent">Для доступа ко всем функциям личного кабинета подтвердите вашу
												почту, перейдя по ссылке в письме</div>
											<form method="POST" action="/email/verification-notification">
												@csrf
												<button class="button button_primary">Выслать письмо повторно</button>
											</form>
										</div>
									@endif
									<div class="submenu-user__item">
										<form action="{{ localize_route('logout') }}" method="POST">
											@csrf
											<button class="submenu-user__link">@lang('header.logout')</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="menu__icon icon-menu"><span></span></button>
				@else
					<button type="button" class="menu__icon icon-menu"><span></span></button>
					<div class="header__btns" data-da=".menu__body, 991.98">
						<a href="{{ localize_route('register') }}" class="header__btn button">@lang('header.register')</a>
						<a href="{{ localize_route('login') }}" class="header__btn button button_primary">@lang('header.login')</a>
					</div>
				@endauth
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="header__container">
            <div class="header__menu menu">
                <nav class="menu__body">
                    <ul class="menu__list">
						@if (Route::has('home'))
                        	<li class="menu__item _active"><a href="{{ localize_route('home') }}" class="menu__link"><span>@lang('header.home')</span></a></li>
						@endif
                        <li class="menu__item" data-spoilers="991.98">
                            <button class="menu__link" type="button" data-spoiler>
                                <span class="_icon-arrow">@lang('header.subject')</span>
                            </button>
                            <ul class="menu__submenu submenu">
								@foreach (subjects() as $subject)
									<li class="submenu__item">
										<a href="{{ localize_route('subject', $subject->slug) }}" class="submenu__link _icon-arrow">
											{{ $subject->{'title_'.loc()} }}
										</a>
									</li>
								@endforeach
                            </ul>
                        </li>
                        {{-- <li class="menu__item"><a href="{{ localize_route('announcement') }}" class="menu__link"><span>@lang('header.announcement')</span></a></li>
                        <li class="menu__item"><a href="{{ localize_route('search') }}" class="menu__link"><span>@lang('header.search')</span></a></li>
                        <li class="menu__item"><a href="{{ route('archive') }}" class="menu__link"><span>@lang('header.archive')</span></a></li> --}}
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>
