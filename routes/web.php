<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/agregarProductos', function () {
    $usuario_id = 2; // ID del usuario para el cual se agregan los productos

    DB::table('carrito')->where('user_id', $usuario_id)->delete();

    DB::table('carrito')->insert([
        ['user_id' => $usuario_id, 'product_id' => 1, 'cantidad' => 2, 'activo' => 1],
        ['user_id' => $usuario_id, 'product_id' => 2, 'cantidad' => 3, 'activo' => 1],
    ]);

    return "Productos agregados al carrito.";
});

Route::get('/miCarrito', function () {
    $usuario_id = 1; // ID del usuario para mostrar el carrito

    $carrito = DB::table('carrito')->where('user_id', $usuario_id)->get();

    if ($carrito->isEmpty()) {
        return "Carrito vacío para el usuario con ID: $usuario_id";
    }

    $productos = DB::table('carrito')
        ->join('productos', 'carrito.product_id', '=', 'productos.id')
        ->where('carrito.user_id', $usuario_id)
        ->select('productos.nombre', 'productos.precio', 'carrito.cantidad')
        ->get();

    $total = $productos->sum(function ($producto) {
        return $producto->precio * $producto->cantidad;
    });

    return response()->json([
        'productos' => $productos,
        'total' => $total,
    ]);
});


//Para agrgar los productos: http://127.0.0.1:8000/agregarProductos
//Para ver carrito: http://127.0.0.1:8000/miCarrito