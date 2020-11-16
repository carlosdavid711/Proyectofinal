@extends('layouts.app')


<html>

<body>

@if(Auth::user()->rol=="CLIENTE")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Productos Dispomibles</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @forelse($Productos as $Producto)
                        @if($Producto->disponibilidad>0)
                        <p> {{$Producto->nombre}}
                            <form action="{{route('productos.destroy', $Producto)}}" method="post">
                                    @csrf @method('DELETE')
                            </form>
                            <a href="{{route('productos.agregarCarrito', $Producto)}}">Agregar al carrito</a>
                        </p>
                        @endif
                    @empty
                        <p>No existen productos </p>
                    @endforelse
                    
                    @if(is_array(session('carrito')) && count(session('carrito'))>0 )
                       <h5>Carrito de Compras</h5>
                        @foreach(session('carrito') as $elemento)
                           <p> {{  json_decode($elemento)->nombre }}  - 
                            {{  json_decode($elemento)->precio }}
                          </p> 
                        @endforeach
                        <h4> Total: {{session('total')}}</h4>
                        <form action="{{route('ventas.store')}}" method="POST">
                            @csrf
                            <button id="btn-add">Agregar</button>
                        </form>
                    @else
                        <p> Carro vacío </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection                    


@else



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestión de Productos </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
            @endif 
            
            
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
            @else
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endif

</body>
</html>
