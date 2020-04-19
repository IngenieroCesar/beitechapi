<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_detail;


class OrderDetailController extends Controller
{
    //Retornamos todos los datos:
    public function index()
    {
        return response()->json(Order_detail::all());
    }
}
