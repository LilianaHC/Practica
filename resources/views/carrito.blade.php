@extends('master')

@section('titulo', 'Carrito')

@section('contenido')
<div class="wrapper">
    <main class="content">
        <br>
        <div class="container text-center">
            <h1>Carrito de items</h1>
            <p class="text-end">
            <a href="{{ route('carrito-vaciar') }}" class="btn btn-danger">Vaciar carrito <i class="bi bi-trash3-fill"></i></a>
            </p>

            @if (count($carrito) > 0)
                <hr>
                <table class="table table-striped table-bordered table-hover table-dark margenTabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carrito as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>${{ number_format($item->precio, 0) }}</td>
                            <td>
                            <input type="number" min="1" max="50" value="{{ $item->cantidad }}" id="producto_{{ $item->id }}">
                                <a href="#" class="btn btn-warning btn-update-item" data-href="{{ route('carrito-actualizar', $item->id) }}" data-id="{{ $item->id }}">
                                    <i class="bi bi-repeat"></i>
                                </a>
                            </td>
                            <td>{{ $item->precio * $item->cantidad }}</td>
                            <td>
                                <a href="{{ route('carrito-borrar', $item->id) }}">
                                    <i class="bi bi-cart-x" style="font-size: 22px;"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                <h3><span class="badge bg-success">${{ number_format($total, 2) }}</span></h3>
                </div>
                <hr>
                <p>
                    <a class="btn btn-info" href="{{ route('productos.index') }}">
                        <i class="bi bi-chevron-left"></i> Seguir Agregando
                    </a>
                    @if(count($carrito))
                    <a class="btn btn-success" href="{{ route('ordenar') }}"> Ordenar <i class="bi bi-chevron-right"></i></a>
                    @endif
                </p>
            @else
            <h1><span class="badge bg-warning text-dark">No hay productos en el carrito</span></h1>
            @endif
        </div>
    </main>

</div>
@endsection