@php //var_dump($errors) @endphp
@if ($errors->any())
    <div class="alert alert-danger">
        <p><strong>Por favor arregla los siguientes errores:</strong></p>
        <br>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif