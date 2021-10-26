@if ($post->exists)
    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
        @method('PATCH')
    @else
        <form method="POST" action="{{ route('admin.posts.store') }}">
@endif
@csrf
<div class="form-group">
    <label for="title">Titolo</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        placeholder="Scrivi il titolo" value="{{ old('title', $post->title) }}">
    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="content">Contenuto del post</label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
        rows="5">{{ old('content', $post->content) }}</textarea>
    @error('content')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="image">Immagine</label>
    <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
        placeholder="Inserisci l'url di un'immagine" value="{{ old('image', $post->image) }}">
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="category_id">Categoria</label>
    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
        <option value="">Nessuna categoria</option>
        @foreach ($categories as $category)
            <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<fieldset class="mb-3 @error('tags') is-invalid @enderror">
    <legend class="h6">Tags</legend>
    @foreach ($tags as $tag)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                name="tags[]" @if (in_array($tag->id, old('tags', $tagIds ?? []))) checked @endif>
            <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
        </div>
    @endforeach
</fieldset>
@error('tags')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror

{{-- <button type="reset" class="btn btn-warning">Reset</button> --}}

<button type="submit" class="btn btn-success">Salva</button>
</form>
