<header class="header">
    <div class="header__top">
        <div class="header__container">
            <a href="/" class="logo">
                <span>crc</span>
                <span>Conference Management Software</span>
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
						<a href="" class="header__link"><img src="{{ Vite::asset('resources/img/user.svg') }}" alt="Image"></a>
						<a href="" class="header__link">
							<span></span>
							<img src="{{ Vite::asset('resources/img/notification.svg') }}" alt="Image">
						</a>
						<form action="{{ localize_route('logout') }}" method="POST">@csrf<button>@lang('header.logout')</button></form>
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
                                <li class="submenu__item">
									<a href="{{ localize_route('subject', 'Математика') }}" class="submenu__link _icon-arrow">@lang('header.math')</a>
                                </li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.phis')</a>
								</li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.chem')</a>
								</li>
								<li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.geo')</a>
								</li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.comp')</a>
                                </li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.eng')</a>
                                </li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.med')</a>
								</li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.life')</a>
                                </li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.soc')</a>
								</li>
                                </li>
                                <li class="submenu__item">
									<a href="" class="submenu__link _icon-arrow">@lang('header.train')</a>
								</li>
                            </ul>
                        </li>
                        <li class="menu__item"><a href="{{ localize_route('announcement') }}" class="menu__link"><span>@lang('header.login')</span></a></li>
                        <li class="menu__item"><a href="{{ localize_route('search') }}" class="menu__link"><span>@lang('header.search')</span></a></li>
                        <li class="menu__item"><a href="{{ route('archive') }}" class="menu__link"><span>@lang('header.archive')</span></a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>
