@extends('layouts.app')


<html>

<body>
<h1> {{ Auth::user()->rol }} </h1>



@if(Auth::user()->rol=="CLIENTE")
<p> Contnido del cliente </p>
@forelse($Productos as $Producto)


<p> {{$Producto->nombre}}
       <form action="{{route('productos.destroy', $Producto)}}" method="post">
                    @csrf @method('DELETE')
                   
                </form>

<a href="{{route('productos.agregarCarrito', $Producto)}}">Agregar al carrito</a>


</p>





            @empty
            <p>No existen productos </p>
             @endforelse

@foreach(json_decode(session('carrito', true)) as $elemento)
    {{ $elemento->nombre }} 
    @endforeach




@else



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Gestion de productos</h3>
            @if($errors)->any())
@foreach($errors->all() as $error)
<p>{{$error}}</p>p>
@endforeach
@endif 

@forelse($Productos as $Producto)


<p> {{$Producto->nombre}}
       <form action="{{route('productos.destroy', $Producto)}}" method="post">
                    @csrf @method('DELETE')
                   <button class="btn-delete">Eliminar</button>
                </form>

<a href="{{route('productos.edit', $Producto)}}">Editar</a>

</p>





            @empty
            <p>No existen productos </p>
             @endforelse
    
    <form action="{{route('productos.store')}}" method="POST">
        @csrf
        <label for="">Nombre</label>
        <input type="text" name="nombre">
        <label for="">Precio</label>
        <input type="text" name="precio">
        <label for="">disponibilidad</label>
        <input type="text" name="disponibilidad">
        <button id="btn-add">Agregar</button>
    </form>



@if(isset($productoEdicion))
     <form action="{{route('productos.update', $productoEdicion)}}" method="POST">
    @csrf @method('PATCH')
    <label for="">Nombre</label> <br>
    <input name="nombre" type="text" value="{{$productoEdicion->nombre}}"> <br>
    <label for="">Precio</label> <br>
    <input name="precio" type="text" value="{{$productoEdicion->precio}}"> <br>
 <label for="">Disponibilidad</label> <br>
    <input name="disponibilidad" type="text" value="{{$productoEdicion->disponibilidad}}"> <br>
    <button id="btn-edit">Editar</button>
</form>
@endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection















@endif






</body>
</html>
