<div class="row">
    @foreach ($products as $productItem)
        <div class="mb-3 col-3">
            @component('component.product', ['product' => $productItem])
            @endcomponent
        </div>
    @endforeach
</div>