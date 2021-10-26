@extends('layouts.app')

@section('content')


    <div class="container">
        <h1>{{ $post->title }}</h1>
        <h4>Categoria: @if ($post->category){{ $post->category->name }} @else nessuna categoria @endif</h4>
        <p>{{ $post->content }}</p>
        <address>Pubblicato il: {{ $post->getFormattedDate('created_at') }}</address>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning ml-2">Modifica</a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post" class="delete-button">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-2">Elimina</button>
            </form>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/confirm-delete.js') }}"></script>
@endsection
