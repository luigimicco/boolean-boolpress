{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Attenzione: ci sono errori nel form</strong>
    </div>
@endif --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
