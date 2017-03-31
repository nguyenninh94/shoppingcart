@extends('layouts.app')

@section('content')
   <div class="container">
   	<div class="row">
   		<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
   			<h1 style="color: red; font-weight: bold;">{{ trans('app.Checkout') }}</h1>
   			<h4>{{ trans('app.YourTotal') }}: <span>$</span> {{$total}}</h4>
   			<div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
   				{{Session::get('error')}}
   			</div>
   			<form action="{{route('payment.stripe')}}" id="checkout-form" method="POST">
   				<div class="row">
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="name">{{ trans('app.Name') }}</label>
   							<input type="text" name="name" id="name" class="form-control" required>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="phone">{{ trans('app.Phone') }}</label>
   							<input type="text" name="phone" id="phone" class="form-control" required>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="name">{{ trans('app.Province') }}</label>
   						    <select name="province" id="province" class="form-control">
   						        <option value="">{{ trans('app.SelectProvince') }}</option>
   						        @foreach($provinces as $pro)
   						    	    <option value="{{$pro->id}}">{{$pro->name}}</option>
   						    	@endforeach
   						    </select>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="district">{{ trans('app.District') }}</label>
   							<select name="district" id="district" class="form-control" required></select>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="ward">{{ trans('app.Ward') }}</label>
   							<select name="ward" id="ward" class="form-control" required></select>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="card-name">{{ trans('app.CardHolderName') }}</label>
   							<input type="text" name="card-name" id="card-name" class="form-control" required>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="card-number">{{ trans('app.CreditCardNumber') }}</label>
   							<input type="text" name="card-number" id="card-number" class="form-control" required>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="card-expiry-month">{{ trans('app.EXpirationMonth') }}</label>
   							<input type="text" name="card-expiry-month" id="card-expiry-month" class="form-control" required>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="card-expiry-year">{{ trans('app.EXpirationYear') }}</label>
   							<input type="text" name="card-expiry-year" id="card-expiry-year" class="form-control" required>
   						</div>
   					</div>
   					<div class="col-xs-12">
   						<div class="form-group">
   							<label for="card-cvc">{{ trans('app.CVC') }}</label>
   							<input type="text" name="card-cvc" id="card-cvc" class="form-control" required>
   						</div>
   					</div>
   					{{csrf_field()}}
   					<button class="btn btn-success" type="submit" class="button">{{ trans('app.Buynow') }}</button>
   				</div>
   			</form>
   		</div>
   	</div>
   </div>
@endsection()

@section('script')
   <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript" src="{{url('js/stripe.js')}}"></script>
   
@endsection()

