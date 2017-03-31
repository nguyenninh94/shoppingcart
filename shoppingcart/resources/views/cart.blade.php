@extends('layouts.app')

@section('content')
   <div class="container">
        <p><a href="{{ url('shop') }}">{{ trans('app.Home') }}</a> / {{ trans('app.Cart') }}</p>
        <h1>{{ trans('app.YourCart') }}</h1>

        <hr>

        @include('partials.flash')

        @if (sizeof(Cart::content()) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th>{{ trans('app.Name') }}</th>
                        <th>{{ trans('app.Product') }}</th>
                        <th>{{ trans('app.Quantity') }}</th>
                        <th>{{ trans('app.Price') }}</th>
                        <th>{{ trans('app.Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                        <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('img/' . $item->model->image) }}" alt="product" style="with:70px;height: 60px;" class="img-responsive cart-image"></a></td>
                        <td>
                            <form action="{{route('cart.update', ['rowId' => $item->rowId])}}" method="POST">
                            	{{csrf_field()}}
                            	{{method_field('PATCH')}}
                            	<input type="text" name="qty" value="{{$item->qty}}" style="width:70px;">
                                <input type="submit" class="btn btn-success" value="{{ trans('app.Update') }}">
                            </form>
                        </td>
                        <td>${{ $item->subtotal }}</td>
                        <td class=""></td>
                        <td>
                            <form action="{{route('cart.destroy', ['rowId' => $item->rowId])}}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                {{method_field('DELETE')}}
                                <input type="submit" class="btn btn-danger btn-sm" value="{{ trans('app.Remove') }}">
                            </form>

                            <form action="" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="submit" class="btn btn-success btn-sm" value="{{ trans('app.ToWishlist') }}">
                            </form>
                        </td>
                    </tr>

                    @endforeach
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">{{ trans('app.SubTotal') }}</td>
                        <td>${{ Cart::instance('default')->subtotal() }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">{{ trans('app.Tax') }}</td>
                        <td>${{ Cart::instance('default')->tax() }}</td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="small-caps table-bg" style="text-align: right">{{ trans('app.YourTotal') }}</td>
                        <td class="table-bg">${{ Cart::total() }}</td>
                        <td class="column-spacer"></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>

            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">{{ trans('app.ContinueShopping') }}</a> &nbsp;
            <a href="{{url('payment')}}" class="btn btn-success btn-lg">{{ trans('app.ProceedToCheckout') }}</a>

            <div style="float:right">
                <form action="{{url('/emptycart')}}" method="POST">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-danger btn-lg" value="{{ trans('app.EmptyCart') }}">
                </form>
            </div>

        @else
            <h3>{{ trans('app.HaveCart') }}</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">{{ trans('app.ContinueShopping') }}</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->
@endsection()