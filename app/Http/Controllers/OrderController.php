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
        
        //Consulta para listar ordenes de compra de cada usuario
        $orders= DB::table('orders')->select('orders.created_at as creationdate',
                    'orders.id as orderid', 'orders.total as total', 
                    DB::raw("(GROUP_CONCAT(order_details.quantity SEPARATOR ', ')) as `quantity`"),
                    DB::raw("(GROUP_CONCAT(products.name SEPARATOR ', ')) as `products`") )
                 ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                 //Tabla para relaciónar con la orden
                 ->join('product_user', 'orders.user_id', '=', 'product_user.user_id')
                 ->join('products', 'product_user.product_id', '=', 'products.id')
                 ->whereColumn('order_details.description', 'products.description')
                 //Condicional para el id del usuario
                 ->where('orders.user_id', $request->id)
                 ->groupBy('orders.id' );
        $getorder = $orders->get();

        //Generamos un arreglo con los datos necesarios basados en el ID del cliente


        return response()->json($getorder);
    }

    //Eviamos todas nuestras ordenes:
    public function create( Request $request)
    {   
        //Persistimos los datos resividos para trabajar con ellos
        //Existe un error de diseño del objeto en donde no logre ciclarlo
        //para no tener que asignar cada valor independiente
        $userid = $request->userid;
        unset($request['userid']);
        //Pasamos nuestro objeto a un arreglo
        $products = $request->toArray();

        //Asignamos nombre de producto y la cantidad
        foreach($products as $product){
            if($product['name'] != ""){
                $nombreproductos[] = $product['name'];
                $cantidades[] = $product['quantity'];
            }
        }
//--------------------------------------------------------------------------------
        //Relación Productos y Usuario
        $productos = Product::all();
        //Buscamos los ID's de los productos correspondientes a la orden
        foreach($productos as $producto){
            foreach ($nombreproductos as $key => $nombre) {
                if($producto->name == $nombre){
                    $idproductos[] = $producto->id;
                    $precios[] = $producto->price;
                }
            }
        }
        //Creamos la relacion entre el usuario y los productos
        $user = User::find($userid);
        $user->products()->attach($idproductos);      

//--------------------------------------------------------------------------------
        //Establecemos el total de la compra
        for($ind = 0; $ind < count($precios); $ind++){
            $totales[$ind] = $precios[$ind] * $cantidades[$ind];
        }
        $total = array_sum($totales);

//--------------------------------------------------------------------------------
        //Generamos nuestra order
            $neworder = new Order();
            $neworder->user_id = $userid;
            $neworder->total = $total;
            $neworder->save();

//--------------------------------------------------------------------------------
    //Creación de order_details:
        //Traemos el id de la ordern
        $lastestorder = DB::table('orders')->select('id')->orderBy('id','DESC')->take(1)->get();

        //Ciclamos la creación ya que esta depende de el numero de producto que se crean, 
        //y no del numero de ordenes 
        $ind = 0;
        foreach($productos as $producto){
            foreach ($nombreproductos as $key => $nombre) {
                if($producto->name == $nombre){

                    $neworder_detail = new Order_detail();
                    $neworder_detail->order_id = $lastestorder[0]->id;
                    $neworder_detail->description = $producto->description;
                    $neworder_detail->price = $precios[$ind];
                    $neworder_detail->quantity = $cantidades[$ind];
                    $neworder_detail->save();

                    $ind++;
                }
            }
            
        }



        return response()->json(['message' => 'Orden Creada satisfactoriamente!, verifica tus ordenes aquí!']);
    }
}
