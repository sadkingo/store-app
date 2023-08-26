@push('scripts')
<script>
   {{ $varName }}.push({
    "id": {{ $product->id }},
    "img": "{{ asset($product->image_url) }}",
    "title": "{{ $product->name }}",
    "price": {{ $product->price }},
    "instock": 99
})
</script>
@endpush
