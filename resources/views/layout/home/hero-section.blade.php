<section class="home" id="home">
    <div class="home__container container grid">
        <div class="home__img-bg">
            <img src="{{ versionedAsset("$homeProduct->image_url") }}" alt="" class="home__img">
        </div>
        <div class="home__social">
            <a href="https://www.facebook.com/" target="_blank" class="home__social-link">
                Facebook
            </a>
            <a href="https://twitter.com/" target="_blank" class="home__social-link">
                Twitter
            </a>
            <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                Instagram
            </a>
        </div>
        <div class="home__data">
            <h1 class="home__title">NEW WATCH <br> {{ $homeProduct->name }}</h1>
            <p class="home__description">{{ $homeProduct->description }}</p>
            <span class="home__price">${{ $homeProduct->price }}</span>
            <div class="home__btns">
                <a href="product/{{ $homeProduct->id }}" class="button button--gray button--small">Discover</a>
                <button class="button home__button" onclick="addToCart({{ $homeProduct->id }})">ADD TO CART</button>
            </div>
        </div>
    </div>
</section>
