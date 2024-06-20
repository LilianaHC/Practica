<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductosController extends Controller
{
    public function __construct() {
        //middleware por defecto (da error))
        //$this->middleware = (['auth','admin']);

        //middleware se a modificado: (realiza la misma funcion)
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }
    
}
