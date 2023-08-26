@extends('layout.app')
@section('body')
    {{--  load product js  --}}
    @include('component.product' , ['product'=>$product ,'varName'=>'products'])
    {{--  todo product images  --}}
    @include('component.product-slider', ['product' => $product])
    @include('component.product-related')
@endsection
