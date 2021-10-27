@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invio email</div>

                <div class="card-body">

                    <h1>Grazie</h1>

                    @if (session('alert-message'))
                    <div class="alert alert-{{ session('alert-type') }}">
                        {{ session('alert-message') }}
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
