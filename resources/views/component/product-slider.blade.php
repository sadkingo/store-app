
<div class="m-auto mt-5 d-flex mw-75 px-md-5 container">
    <div class="row p-md-5 w-100">
        <div class="container col-lg-6 ">
            <!-- Swiper -->
            <div class="container rounded-3 m-auto">
                <div class="swiper mySwiper2 rounded-top-3" style="background-color: var(--first-color);">
                    <div class="swiper-wrapper text-center">
                        <div class="swiper-slide mt-1 rounded-3 overflow-hidden h-auto my-auto">
                            <img class="object-fit-contain" src="{{ versionedAsset("$product->image_url") }}" />
                        </div>
                        @foreach ($product->images as $image)
                        <div class="swiper-slide my-auto">
                            <img class="object-fit-contain" src="{{ versionedAsset("$image->image_url") }}" />
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-black rounded-bottom-3">
                    <div class="swiper mySwiper w-50 p-1">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide border rounded-3 border-secondary overflow-hidden h-auto text-center">
                                <img class="object-fit-contain" src="{{ versionedAsset("$product->image_url") }}" />
                            </div>
                            @foreach ($product->images as $image)
                            <div
                                class="swiper-slide border rounded-3 border-secondary overflow-hidden h-auto text-center">
                                <img class="object-fit-contain" src="{{ versionedAsset("$image->image_url") }}" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="container col-lg-6 rounded-3 text-center d-flex flex-column justify-content-between bg-black bg-opacity-25">
            <div>
                <h1 class="mt-3">{{ $product->name }}</h1>
                <h3 class="home__price">{{ '$ '.$product->price }}</h3>
                <p class="fs-4">{{ $product->description }}</p>
            </div>
            <div>
                <button class="button home__button mb-5" onclick="addToCart({{ $product->id }})">ADD TO CART</button>
            </div>
        </div>
    </div>
</div>
