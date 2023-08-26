@extends('layout.app')

@foreach ($products as $product)
    @include('component.product', ['product' => $product, 'varName' => 'products'])
@endforeach

@section('body')
    <div class="featured__container grid mt-5">
        @foreach ($products as $product)
            @include('layout.home.product-card', ['product' => $product])
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
@endsection
