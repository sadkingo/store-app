<header class="header" id="header">
    <nav class="nav container">
        <a href="{{ route('home') }}" class="nav__logo">
            <i class='bx bxs-watch nav__logo-icon'></i> Rolex
        </a>
        <div class="nav__menu" id="nav-menu">
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
        </div>
        <div class="nav__btns">
            <i class='bx bx-moon testimonial__perfil-name' style="cursor: pointer;" id="theme-button"></i>
            <div class="nav__shop" id="cart-shop">
                <i class='bx bx-shopping-bag testimonial__perfil-name'></i>
                <span class="total-items-cart testimonial__perfil-name"></span>
            </div>
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
            <button class="button m-auto" onclick="">CheckOut</button>
        </div>
    </div>
</header>
