@extends('master')
@section('titulo', 'Listado de Productos')

@section('contenido')

    {{-- Mostrar el mensaje de éxito si existe --}}
        @if (session('success'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-8 col-10">
                        <div class="alert alert-success text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4>{{ session('success') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        @endif


<br>

    <div class="container text-center">
        <h1>Listado de Productos</h1>
        
        <hr>
        <table class="table table-striped table-bordered table-hover table-dark">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Agregar</th>
                </tr>
            </thead>

            <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{$producto->nombre}}</td>
                    <td>${{number_format($producto->precio,0)}}</td>
                    <td>{{$producto->cantidad}}</td>

                    <td>
                        <a href="{{ route('carrito-agregar', $producto->id)}}">
                            <i class="bi bi-cart-plus" style="font-size: 22px;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr>
    </div>
@endsection