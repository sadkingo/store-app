<header class="header" id="header">
    <nav class="nav container px-md-0 px-5">
        <a href="{{ route('home') }}" class="nav__logo">
            <i class='bx bxs-watch nav__logo-icon'></i> Rolex
        </a>
        <div class="nav__menu d-flex" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{ route('home') . '#home' }}" class="nav__link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('home') . '#featured' }}" class="nav__link">Featured</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('home') . '#products' }}" class="nav__link">Products</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('home') . '#new' }}" class="nav__link">New</a>
                </li>
            </ul>
            <div class="nav__close" id="nav-close">
                <i class='bx bx-x'></i>
            </div>
            @guest
                <ul class="nav__list ms-md-5">
                    <li class="nav__item ms-md-25">
                        <a href="{{ route('login') }}" class="nav__link">Login</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('register') }}" class="nav__link">Register</a>
                    </li>
                </ul>
            @endguest
        </div>
        @auth
            <div class="dropdown float-end nav__btns">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                        class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                    @if (authUser()->user_type === 'admin')
                        <li><a class="dropdown-item" href="{{ route('filament.admin.auth.login') }}">Admin Panel</a></li>
                    @endif
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Sign out</a></li>
                </ul>
            </div>
        @endauth
        <div class="nav__btns">
            <i class='bx bx-moon testimonial__perfil-name' style="cursor: pointer;" id="theme-button"></i>
            @auth
            <div class="nav__shop" id="cart-shop">
                <i class='bx bx-shopping-bag testimonial__perfil-name'></i>
                <span class="total-items-cart testimonial__perfil-name"></span>
            </div>
            @endauth
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>
        </div>
    </nav>
    <div class="bg-black bg-opacity-25 cart" id="cart">
        <i class='bx bx-x cart__close' id="cart-close"></i>
        <h2 class="cart__title-center">My cart</h2>
        <div class="cart__container">

        </div>
        <div class="cart__prices">
            <span class="cart__prices-item"></span>
            <span class="cart__prices-total"></span>
        </div>
        <div class="d-flex justify-content-center">
            {{--  <a href="{{ route('checkout') }}">  --}}
                <button class="button m-auto" onclick="sendCart()">CheckOut</button>
            {{--  </a>  --}}
        </div>
    </div>
</header>
