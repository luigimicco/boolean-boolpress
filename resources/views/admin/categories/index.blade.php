@extends('layouts.app')




@section('content')
    <div class="container">
        @if (session('alert-message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('alert-message') }}
            </div>
        @endif
        <header class="my-5 d-flex justify-content-between align-items-center">
            <h1>Categorie</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Nuova Categoria</a>
        </header>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Colore</th>
                    <th scope="col">N. Post</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td><span
                                class="badge badge-pill badge-{{ $category->color ?? 'light' }}">{{ $category->color ?? 'nessuno' }}</span>
                        </td>
                        <td>@if ($category->posts){{ count($category->posts) }} @else 0 @endif</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-primary">Vai</a>
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="btn btn-warning ml-2">Modifica</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post"
                                class="delete-button">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-2">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Non ci sono categorie da visualizzare.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>




    </div>
    @section('scripts')
        <script src="{{ asset('js/confirm-delete.js') }}"></script>
    @endsection
@endsection
