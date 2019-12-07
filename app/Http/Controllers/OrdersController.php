<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
    public function index()
    {
    	$orders = Order::all();

    	return view("orders.index", ["orders" => $orders]);
    }

    public function show($id)
    {
    	$order = Order::findOrFail($id);

    	return view("orders.details", ["order" => $order]);
    }
}
