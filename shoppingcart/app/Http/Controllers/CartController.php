<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use App\Province;
use DB;
use Session;
use \Stripe\Stripe;
use \Stripe\Charge;
use App\Customer;
use App\Order;

class CartController extends Controller
{
    public function index()
    {
    	return view('cart');
    }

    public function store(Request $request)
    {
    	$duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
    		return $cartItem->id === $request->id;
    	});

    	if(!$duplicates->isEmpty()) {
    		return redirect('cart')->with('success', 'Item already exists in your cart!');
    	}

    	Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');

    	return redirect('cart')->with('success', 'Item was added to your cart!');
    }

    public function update(Request $request, $id)
    {
    	Cart::update($id, $request->qty);
    	return back()->with('success', 'Item was updated successfully!');
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success', 'Deleted item successfully!');
    }

    public function emptyCart()
    {
    	Cart::destroy();
    	return back()->with('success', 'Delete your cart successfully');
    }

    public function getPayment()
    {
    	return view('checkout.payment');
    }

    public function getStripe()
    {
        $total = Cart::total();
        /*$provinces = [];
        foreach(Province::all() as $province)
        {
        	$provinces[] = $province;
        }*/
        return view('checkout.stripe', compact('total'));
    }

    public function getDistrict($id)
    {
       $district = DB::table('districts')
                     ->select('id', 'name')
                     ->where('province_id', $id)
                     ->get();
       return response()->json($district);              
    }

    public function getWard($id)
    {
       $ward = DB::table('wards')
                 ->select('id', 'name')
                 ->where('district_id', $id)
                 ->get();
       return response()->json($ward);          
    }

    public function postStripe(Request $request)
    {
    	$total = Cart::total();
    	$product_id = [];
    	foreach(Cart::content() as $pr)
    	{
            $product_id[] = $pr->id;
    	}

    	//dd($product_id);

        Stripe::setApikey('sk_test_Sg4cajKaNNqlorwTIjlTpk8s');

        try {
           $charge = Charge::create([
               "amount" =>  $total * 100,
               "currency" => "usd",
               "source" => $request->input('stripeToken'),
               "description" => "Test test"
           	]);

           $customer = Customer::create([
              'name' => $request->name,
              'phone' => $request->phone,
              'province' => $request->province,
              'district' => $request->district,
              'ward' => $request->ward
           	]);

           $order = Order::create([
               'total' => $charge->amount,
               'status' => 1,
               'customer_id' => $customer->id
           	]);

           $order->products()->attach($product_id);

        } catch(\Exception $ex) {
            return back()->with('error', 'payment failed!please check info again.');
        }

        Session::forget('cart');
        return redirect('shop')->with('success', 'Payment successfully!');
    }
}
