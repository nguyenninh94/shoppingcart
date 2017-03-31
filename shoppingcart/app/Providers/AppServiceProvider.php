<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Product;
use App\Province;
use View;
use DB;
use \Cart as Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if($request->has('search')) {
            $products = Product::search($request->search)->get();
        } else {
            $products = DB::table('products')->get();
        }

        View::share('products', $products);

        $provinces = [];
        foreach(Province::all() as $province)
        {
            $provinces[] = $province;
        }

        View::share('provinces', $provinces);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
