<article class="featured__card m-1">

    <img src="{{ versionedAsset($product->image_url) }}" alt="" class="featured__img">
    <div class="featured__data">
        <h3 class="featured__title">{{ $product->name }}</h3>
        <span class="featured__price">{{ "$" . $product->price }}</span>
    </div>
    <div class="featured__button">
        <a href="product/{{ $product->id }}" class="featured__button button button--gray button--small">Discover</a>
        <button class="button featured__button" onclick="addToCart({{ $product->id }})">ADD TO CART</button>
    </div>

</article>
