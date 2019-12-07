<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    public function dataFile()
    {
    	$products = Product::all();
    	$data = json_encode($products->toArray());
		$fileName = 'products.json';
	    File::put(public_path('/upload/json/'.$fileName), $data);

	    return Response::download(public_path('/upload/json/'.$fileName));
    }
}
