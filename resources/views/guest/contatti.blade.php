@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invio email</div>

                <div class="card-body">


                    <form method="POST" action="{{ route('contatti.invio') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                placeholder="Nome contatto" >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>      
                        
                        <div class="form-group">
                            <label for="email">Nome</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                placeholder="Indirizzo email" >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>      
                        
                        <div class="form-group">
                            <label for="message">Messaggio</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message"
                                rows="5"></textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Invia</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
