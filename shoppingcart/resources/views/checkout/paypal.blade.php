@extends('layouts.app')

@section('content')
   <div class="container">
   	<div class="row">
         
         @include('partials.flash')

   		<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
   			<h1 style="color: red; font-weight: bold;">{{ trans('app.Checkout') }}</h1>
   			<h4>{{ trans('app.YourTotal') }}: <span>$</span> {{$total}}</h4>
   			
   			<form action="{{route('paypal.store')}}" id="checkout-form" method="POST">
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
   					
   					{{csrf_field()}}
   					<button class="btn btn-success" type="submit" class="button">{{ trans('app.Buynow') }}</button>
   				</div>
   			</form>
   		</div>
   	</div>
   </div>
@endsection()

