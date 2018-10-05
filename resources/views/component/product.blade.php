<div class="card">
    <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->title }}">
    <div class="card-body">
        <a href="{{ route('catalog-product', ['productID' => $product->id]) }}" class="card-title">{{ $product->title }}</a>
        <div class="card-text">{{ str_limit($product->description, 50) }}</div>
        <div class="mt-1 mb-1">{{ $product->price }}</div>
        
        <a href="{{ $product->url }}" class="btn btn-success" target="_blank">Купить</a>
    </div>
    <div class="mt-1 card-footer">
        Остаток на складе: <span>{{ $product->amount }}</span>
    </div>
</div>