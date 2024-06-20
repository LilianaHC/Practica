<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;

use Session;

class CarritoController extends Controller
{
    //funcion para crear la variable de sesion: permitir guardar todos los ids de los productos agregados   
    public function __construct(){
        if(!Session::has('carrito'))
            Session::put('carrito', array());
        }
    //Función para mostrar la vista del carrito de compras
    public function show(){
        $carrito = Session::get('carrito');
        //return $carrito;
        $total = $this->total();

        return view('carrito', compact('carrito', 'total'));
    }
    //funcion para agregar items al carrito de compras
    public function add($id) {
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);

       $producto->cantidad = 1;

        $carrito[$producto->id] = $producto;
        Session::put('carrito', $carrito);
        //return Session::get('carrito');
        return redirect()->route('carrito');
    }
    //Funcion para borrar item
    public function delete($id) {
        $carrito = Session::get('carrito');
        unset($carrito[$id]);
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }
    //funcion para vaciar el carrito de compras
    public function trash() {
        Session::forget('carrito');
        return redirect()->route('carrito');
    }
    //Función para actualizar cantidad en el carrito
    public function update($id, $cantidad){
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);
        $carrito[$producto->id]->cantidad = $cantidad;
    
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
        }
        //Funcion para calcular el total
    public function total(){
        $carrito = Session::get('carrito');

        $total = 0;

        foreach ($carrito as $item) {
            $total +=$item->precio*$item->cantidad;
        }

        return $total;
    }
    //Función para guardar el pedido
    public function guardarPedido(){

        $carrito = Session::get('carrito');
        if (count($carrito)) {
            $now = new \DateTime();
            $numero= $now->format('Ymd-His');
            foreach ($carrito as $producto) {
                $this->guardarItem($producto, $numero);
           }
        }

        // Vaciar el carrito después de guardar el pedido
        $this->trash();

        return redirect()->route('productos.index')->with('success', 'Pedido guardado correctamente');
    }
    protected function guardarItem($producto, $numero){
        $productoguardado = Pedido::create([
            'numero' => $numero,
            'idproducto' => $producto->id,
            'cantidad' => $producto->cantidad,
            'precio'=>$producto->precio
            ]);
        }
}
