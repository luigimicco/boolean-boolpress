@extends('layouts.app')




@section('content')
    <div class="container">
        @if (session('alert-message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('alert-message') }}
            </div>
        @endif
        <header class="my-5 d-flex justify-content-between align-items-center">
            <h1>I miei post</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Nuovo Post</a>
        </header>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Scritto il</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if ($post->category)
                                <span
                                    class="badge badge-pill badge-{{ $post->category->color ?? 'light' }}">{{ $post->category->name }}</span>
                            @else -
                            @endif

                        </td>
                        <td>
                            @forelse ($post->tags as $tag)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                            @empty -

                            @endforelse
                        </td>
                        <td>
                        @if ($post->author){{ $post->author->name }} @else Anonimo
                            @endif
                        </td>
                        <td>{{ $post->getFormattedDate('created_at') }}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">Vai</a>
                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                class="btn btn-warning ml-2">Modifica</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post"
                                class="delete-button">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-2">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Non ci sono posta da visualizzare.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

        <footer class="d-flex justify-content-end">
            {{ $posts->links() }}
        </footer>
        <hr />
        <section id="posts-by-categories" class="mt-5">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <header class="d-flex">
                            <h2 class="mb-3">{{ $category->name }}</h2>
                            <p class="text-muted text-small">({{ count($category->posts) }})</p>
                        </header>
                        @forelse($category->posts as $post)
                            <h5 class="my-2"><a
                                    href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></h5>
                        @empty Nessun post per questa categoria
                        @endforelse
                    </div>
                @endforeach
            </div>
        </section>



    </div>
    @section('scripts')
        <script src="{{ asset('js/confirm-delete.js') }}"></script>
    @endsection
@endsection
