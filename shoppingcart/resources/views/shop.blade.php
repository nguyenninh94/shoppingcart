@extends('layouts.app')

@section('content')
   <div class="container">

        @include('partials.flash')

        <div class="jumbotron text-center clearfix">
            <h2>Laravel Shopping Cart Example</h2>
            <p>An example Laravel App that demos the basic functionality of a typical e-commerce shopping cart.</p>
            <p>
                <a href="http://andremadarang.com/implementing-a-shopping-cart-in-laravel/" class="btn btn-primary btn-lg" target="_blank">Blog Post</a>
                <a href="https://github.com/drehimself/laravel-shopping-cart-example" class="btn btn-success btn-lg" target="_blank">GitHub Repo</a>
            </p>
        </div> <!-- end jumbotron -->

        @foreach ($products->chunk(4) as $items)
            <div class="row">
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                <p>{{ $product->price }}</p>
                                </a>
                                <form action="{{route('cart.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-success">
                                         <span class="glyphicon glyphicon-shopping-cart"></span> {{ trans('app.AddToCart') }}
                                    </button>
                                </form>
                                <br/>
                                <span>
                                    <div class="fb-like" data-href="http://127.0.0.1:8000/shop" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                </span>
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach
        
        <div class="row">
            <div class="col-md-8 col-md-offset-3">
                <div class="fb-comments" data-href="http://127.0.0.1:8000/shop" data-numposts="5"></div>
            </div>
        </div>
    </div> <!-- end container -->
@endsection()