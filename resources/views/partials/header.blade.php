<header class="header">
    <div class="header__top">
        <div class="header__container">
            <a href="/" class="logo">
                <span>crc</span>
                <span>Conference Management Software</span>
            </a>
            <div class="header__action">
                <div class="lang">
                    <button class="lang__btn _icon-arrow" type="button">ru</button>
                    <ul class="lang__submenu submenu">
                        <li class="submenu__item"><a href="" class="submenu__link">eng</a></li>
                        <li class="submenu__item"><a href="" class="submenu__link">de</a></li>
                        <li class="submenu__item"><a href="" class="submenu__link">fr</a></li>
                    </ul>
                </div>
                
				@auth
					<div class="header__btns">
						<a href="" class="header__link"><img src="{{ Vite::asset('resources/img/user.svg') }}" alt="Image"></a>
						<a href="" class="header__link">
							<span></span>
							<img src="{{ Vite::asset('resources/img/notification.svg') }}" alt="Image">
						</a>
						<form action="{{ route('logout') }}" method="POST">@csrf<button>Выйти</button></form>
					</div>
					<button type="button" class="menu__icon icon-menu"><span></span></button>
				@else
					<button type="button" class="menu__icon icon-menu"><span></span></button>
					<div class="header__btns" data-da=".menu__body, 991.98">
						<a href="{{ route('register') }}" class="header__btn button">Регистрация</a>
						<a href="{{ route('login') }}" class="header__btn button button_primary">Войти</a>
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
                        <li class="menu__item _active"><a href="{{ route('home') }}" class="menu__link"><span>Главная</span></a></li>
                        <li class="menu__item" data-spoilers="991.98">
                            <button class="menu__link" type="button" data-spoiler>
                                <span class="_icon-arrow">Субъект</span>
                            </button>
                            <ul class="menu__submenu submenu">
                                <li class="submenu__item"><a href="{{ route('subject', 'Математика') }}" class="submenu__link _icon-arrow">Математика</a>
                                </li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Физика</a></li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Химия</a></li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Информатика</a>
                                </li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Инженерия</a>
                                </li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Медицина</a></li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Наука о жизни</a>
                                </li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Социальная
                                    наука</a></li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Наука о земле</a>
                                </li>
                                <li class="submenu__item"><a href="" class="submenu__link _icon-arrow">Тренинги</a></li>
                            </ul>
                        </li>
                        <li class="menu__item"><a href="{{ route('announcement') }}" class="menu__link"><span>Объявление</span></a></li>
                        <li class="menu__item"><a href="{{ route('search') }}" class="menu__link"><span>Поиск по календарю</span></a></li>
                        <li class="menu__item"><a href="{{ route('archive') }}" class="menu__link"><span>Архив</span></a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>
