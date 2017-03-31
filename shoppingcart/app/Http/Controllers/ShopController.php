<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;

class ShopController extends Controller
{
    
    public function index(Request $request)
    {
        /*if($request->has('search')) {
            $products = Product::search($request->search)->get();
        } else {
            $products = DB::table('products')->get();
        }*/
        
        return view('shop', compact('products'));
    }

    public function show($slug)
    {
    	$product = DB::table('products')->where('slug', $slug)->first();

    	$interested = DB::table('products')->where('slug', '!=', $slug)->get()->random(4);

    	return view('product', compact('product', 'interested'));
    }
}
