<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use Config;
use Session;
use URL;
use Redirect;
use App\Order;
use App\Customer;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
	private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig([$paypal_conf['settings']]);
    }

    public function index()
    {
    	$total = Cart::total();

        /*$provinces = [];
        foreach(Province::all() as $province)
        {
        	$provinces[] = $province;
        }*/
    	return view('checkout.paypal', compact('total'));
    }

    public function create(Request $request)
    {
        // Get the payment ID before session clear
    	$payment_id = Session::get('paypal_payment_id');
    // clear the session payment ID
    	Session::forget('paypal_payment_id');
    	if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
    		return Redirect::route('paypal.index')->with('error', 'Payment failed');
    	}
    	$payment = Payment::get($payment_id, $this->_api_context);
    
    	$execution = new PaymentExecution();
    	$execution->setPayerId(Request::get('PayerID'));

          //Execute the payment
    	$result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { // payment made
    	    return Redirect::route('shop.index')->with('success', 'Payment success');
        }
            return Redirect::route('paypal.index')->with('error', 'Payment failed');
    }

    public function store(Request $request)
    {
    	//dd($this->_api_context);
	    $payer = new Payer();
	    $payer->setPaymentMethod('paypal');
        
        $total = Cart::total();
	    $itemlist = [];
	    $product_id = [];
	    foreach(Cart::content() as $items)
	    {
	    	$item = new Item();
	    	$item->setName($items->name)
	    	     ->setCurrency('USD')
	    	     ->setQuantity($items->qty)
	    	     ->setPrice($items->price);

	    	$itemlist[] = $item;
	    	$product_id[] = $items->id;     
	    }

	    //dd($product_id);

	    //dd($itemlist);
	    // add item to list

	    $item_list = new ItemList();
	    $item_list->setItems($itemlist);

	    $amount = new Amount();
	    $amount->setCurrency('USD')
	        ->setTotal($total);

	    $transaction = new Transaction();
	    $transaction->setAmount($amount)
	        ->setItemList($item_list)
	        ->setDescription('Your transaction description');

	    $redirect_urls = new RedirectUrls();
	    $redirect_urls->setReturnUrl(URL::route('paypal.create'))
	        ->setCancelUrl(URL::route('paypal.create'));
	        
	    $payment = new Payment();
	    $payment->setIntent('Sale')
	        ->setPayer($payer)
	        ->setRedirectUrls($redirect_urls)
	        ->setTransactions(array($transaction));

	    try {
	        $pay = $payment->create($this->_api_context);

	        $customer = Customer::create([
              'name' => $request->name,
              'phone' => $request->phone,
              'province' => $request->province,
              'district' => $request->district,
              'ward' => $request->ward
           	]);

           $order = Order::create([
               'total' => Cart::total(),
               'status' => 1,
               'customer_id' => $customer->id
           	]);

           $order->products()->attach($product_id);

	    } catch (\PayPal\Exception\PPConnectionException $ex) {
	        return Redirect::route('paypal.index')->with('error', 'Payment failed!please check your info again.');
	    }
	    foreach($payment->getLinks() as $link) {
	        if($link->getRel() == 'approval_url') {
	            $redirect_url = $link->getHref();
	            break;
	        }
	    }
	    // add payment ID to session
	    Session::put('paypal_payment_id', $payment->getId());

	    Session::forget('cart');
	    return Redirect::route('shop.index')->with('success', 'Payment successfully!');

	    if(isset($redirect_url)) {
	        // redirect to paypal
	        return Redirect::away($redirect_url);
	    }
	    return redirect()->route('paypal.index')->with('error', 'Payment failed!please check your info again.');
	}
}
