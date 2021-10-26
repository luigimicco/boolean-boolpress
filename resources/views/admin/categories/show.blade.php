@extends('layouts.app')

@section('content')


    <div class="container">
        <h1>{{ $category->name }}</h1>
        <p> Colore: {{ $category->color }}</p>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning ml-2">Modifica</a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" class="delete-button">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-2">Elimina</button>
            </form>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/confirm-delete.js') }}"></script>
@endsection
