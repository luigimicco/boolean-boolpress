@extends('layouts.app')


@section('content')
    <div class="container">
        @include('includes.errors_alert')

        <header class="d-flex justify-content-between align-items-center">
            <h1>Crea Nuova Categoria</h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Indietro</a>
        </header>
        <section id="form">
            @include('includes.admin.categories.form')
        </section>
    </div>
@endsection
