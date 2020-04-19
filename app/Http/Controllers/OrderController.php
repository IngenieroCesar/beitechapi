<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
use App\Order_detail;
use App\Products;

use Illuminate\Http\Request;

class OrderController extends Controller
{   
    //Eviamos todas nuestras ordenes:
    public function index()
    {
        return response()->json(Order::all());
    }
    
    public function show( Request $request ){

        $products = User::find($request->id)->products;
        $orders = User::find($request->id)->orders;







        //Generamos un arreglo con los datos necesarios basados en el ID del cliente
        $orders = [
            "creationdate" => "cesar",
            "orderid" => "cesar",
            "total" => "cesar",
            "products" => $products,
            "quantity" => "cesar",
        ];

        return response()->json($products);
    }
}
