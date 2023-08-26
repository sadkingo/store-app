@extends('layout.app')
@section('body')

    {{--  loading products  --}}
    @foreach ($products as $product)
        @include('component.product', ['product' => $product, 'varName' => 'products'])
    @endforeach

    @foreach ($newProducts as $product)
        @include('component.product', ['product' => $product, 'varName' => 'newArrivals'])
    @endforeach

    @foreach ($featuredProducts as $product)
        @include('component.product', ['product' => $product, 'varName' => 'featured'])
    @endforeach

    @include('component.product', ['product' => $homeProduct, 'varName' => 'home'])

    <main class="main">
        @include('layout.home.hero-section' ,['homeProduct'=>$homeProduct])
        @include('layout.home.featured-section')
        @include('layout.home.story-section')
        @include('layout.home.products')
        @include('layout.home.testimonial')
        @include('layout.home.new-section')
    </main>
@endsection
