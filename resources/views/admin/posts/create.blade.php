@extends('layouts.app')


@section('content')
    <div class="container">
        @include('includes.errors_alert')

        <header class="d-flex justify-content-between align-items-center">
            <h1>Crea Nuovo Post</h1>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Indietro</a>
        </header>
        <section id="form">
            @include('includes.admin.posts.form')
        </section>
    </div>
@endsection
