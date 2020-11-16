<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $Productos = Producto::all();
     return view('admin.index', ['Productos' => $Productos]);
          //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
     
        $fields = request()->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'disponibilidad' => 'required',

        ]);
        Producto::create($fields);
       return redirect()->route('productos.index');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
      $productos = Producto::all();
      $productoEdicion = Producto::find($id); 
       return view('admin.index', ['productoEdicion' => $productoEdicion, 'Productos'=> $productos]);




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id); 
        $fields = request()->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'disponibilidad' => 'required'
        ]);

        $producto->update($fields);
        
         
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }

     public function agregarCarrito($id)
    {
      $productoCarrito = Producto::find($id); 
      session()->push('carrito', json_encode($productoCarrito));
      $productos = Producto::all();  
      $total=0; 
      foreach(session('carrito') as $elemento){
        $total+= json_decode($elemento)->precio;
      }
      session(['total' => $total]);
       return view('admin.index', ['Productos'=> $productos]);
    }    
}
