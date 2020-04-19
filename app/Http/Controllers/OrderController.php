<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
use App\Order_detail;
use App\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrderController extends Controller
{   
    //Eviamos todas nuestras ordenes:
    public function index()
    {
        return response()->json(Order::all());
    }
    
    public function show( Request $request ){
 
        $orders= DB::table('orders')->select('orders.id',
                 DB::raw("(GROUP_CONCAT(order_details.quantity SEPARATOR '-')) as `Cantidad`"),
                 DB::raw("(GROUP_CONCAT(products.name SEPARATOR '-')) as `Porducts`") )
                 ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                 //Tabla para relaciónar con la orden
                 ->join('product_user', 'orders.user_id', '=', 'product_user.user_id')
                 ->join('products', 'product_user.product_id', '=', 'products.id')
                 ->whereColumn('order_details.description', 'products.description')
                 ->groupBy('orders.id' );
        $getorder = $orders->get();



        $orden = DB::table('orders')->select(DB::raw("(GROUP_CONCAT(order_details.id SEPARATOR '-')) as `Cantidad`"))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('orders.id' )
            ->get();


        //Generamos un arreglo con los datos necesarios basados en el ID del cliente


        return response()->json($orden);
    }
}
