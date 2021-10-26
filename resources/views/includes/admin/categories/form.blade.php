@if ($category->exists)
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @method('PATCH')
    @else
        <form method="POST" action="{{ route('admin.categories.store') }}">
@endif
@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        placeholder="Scrivi il titolo" value="{{ old('name', $category->name) }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="color">Colore</label>
    <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
        <option>Nessun colore</option>
        <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected @endif value="success">Verde</option>
        <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected @endif value="danger">Rosso</option>
        <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected @endif value="primary">Blu</option>
        <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected @endif value="warning">Giallo</option>
        <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected @endif value="secondary">Grigio</option>
    </select>
    @error('color')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
<button type="submit" class="btn btn-success">Salva</button>
</form>
