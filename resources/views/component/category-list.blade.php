<div class="jumbotron">
    @foreach ($categories as $item)
        <a href="{{ route('catalog-category', ['categorySlug' => $item->alias], false)}}" class="btn btn-dark mb-1">
            {{ $item->title }}
        </a>
    @endforeach
</div>