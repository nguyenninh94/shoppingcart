@extends('layouts.app')

@section('content')
   <div class="container">
   	<div class="row">
   	    <h2>{{ trans('app.PaymentMethod') }}</h2>
   		<a href="{{url('payment/stripe')}}" class="btn btn-success">Stripe</a>
   		<a href="{{route('paypal.index')}}" class="btn btn-success">Paypal</a>
   	</div>
   </div>
@endsection()