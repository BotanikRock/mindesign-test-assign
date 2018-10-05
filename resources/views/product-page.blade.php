@extends('layout.main')

@section('content')
    <h1>{{ $pageTitle }}</h1>

    <div class="row">
        <div class="col-3">
            @component('component.product', ['product' => $product])
            @endcomponent
        </div>
    </div>

    <h2 class="mt-3">Варианты</h2>

    <table class="table">
        @foreach ($product->offers() as $offerItem)
            <tr>
                <th>{{ $offerItem->price }}</th>
                <th>{{ $offerItem->amount }}</th>
                <th>{{ $offerItem->sales }}</th>
                <th>{{ $offerItem->article }}</th>
            </tr>
        @endforeach
    </table>
@endsection