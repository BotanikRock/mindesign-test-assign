@if(session('flash.formError'))
    <div class="alert alert-danger">
        {{ session('flash.formError') }}
    </div>
@endif

<form class="mb-4" method="GET" action="{{ route('catalog-search') }}" class="mb-2">
    <div class="form-group">
        <label for="search-str"></label>
        <input type="text" class="form-control" id="search-str" name="search-str" required>
    </div>
    <button type="submit" class="btn btn-primary">Искать</button>
</form>