<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
    public function createOrder(Request $request)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     "orders.*.user_name" => "required",
        //     "orders.*.user_phone" => "required",
        //     "orders.*.user_address" => "required",
        //     "orders.*.order_date" => "required",
        //     "orders.*.items" => "required"
        // ]);

    	foreach ($request->orders as $order) {
    		$newOrder = new Order;
    		$newOrder->user_name = $order["user"]["name"];
    		$newOrder->user_phone = $order["user"]["phone"];
    		$newOrder->user_address = $order["user"]["address"];
            // dd(strtotime($order["order_date"]));
    		$newOrder->order_date = date("Y-m-d H:i:s", strtotime($order["date"]));
            $newOrder->unique_id = $order["id"];
    		$newOrder->save();

    		foreach ($order["cartProduct"] as $item) {
    			$orderItem = new OrderItem;
    			$product = Product::find($item["id"]);
    			$orderItem->product_id = $product->id;
    			$orderItem->price = $item["price"];
    			$orderItem->quantity = $item["count"];
                $orderItem->order_id = $newOrder->id;
    			$orderItem->save();
    		}
    	}

    	return $this->jsonResponse("Success");
    }
}
