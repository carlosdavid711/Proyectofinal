@extends('layouts.app')


<html>

<body>
    @section('content')
        <h4>Venta Exitosa!</h4>
        <h6>Resumen</h6>
            @foreach(session('carrito') as $elemento)
                <p> {{  json_decode($elemento)->nombre }}  - 
                    {{  json_decode($elemento)->precio }}
                </p> 
            @endforeach
            <h4> Total: {{session('total')}}</h4>
    @endsection
</body>

</html>