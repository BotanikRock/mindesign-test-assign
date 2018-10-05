@extends('layout.main')

@section('content')

    <h1>{{ $pageTitle }}</h1>

    @if(isset($categories) && $categories->count() > 0)
        @component('component.category-list', ['categories' => $categories]);    
        @endcomponent
    @endif

    @component('component.search-form');    
    @endcomponent

    @isset($products)
        @component('component.product-list', ['products' => $products])
        @endcomponent
    @endisset

@endsection