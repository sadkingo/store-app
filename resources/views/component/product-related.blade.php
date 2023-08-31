<div class="d-grid overflow-hidden">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Other Products</h2>
            <hr>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row justify-content-center">
                @foreach ($randomProducts as $randomProduct)
                    <a href="{{ route('product.show', ['product'=>$randomProduct->id]) }}" class="col-xl-2 col-md-3 bg-black bg-opacity-50 text-center rounded-4 p-1 m-2">
                            <div class="card orangeBg p-3">
                                <img src="{{ versionedAsset("$randomProduct->image_url") }}"
                                    class="m-auto object-fit-contain img-fluid" alt="Image"
                                    style="width: 150px; height: 150px;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $randomProduct->name }}</h5>
                                    <p>{{ Illuminate\Support\Str::limit($randomProduct->description, 50) }}</p>
                                    <h3 class="">${{ $randomProduct->price }}</h3>
                                </div>
                            </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
