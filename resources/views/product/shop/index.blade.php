@extends('layouts.app')

@section('title', 'products')

@section('css')
	<link href="/css/product/shop.css" rel="stylesheet">
@endsection

@section('js')
	<script src="/js/product/shop/cart.js"></script>
@endsection

@section('content')
	<section class="products row">
		@foreach($products as $product)
			<div class="product col col-12 col-sm-6 col-lg-4 col-xl-3">
				<article class="product-card">
					<div class="row">
						<div class="col col-12 picture">
							<img src="{{ $product->getPictureUrl() }}" />
						</div>
					</div>
					<div class="row">
						<div class="col title">
							{{ $product->name }}
						</div>
					</div>
					<div class="row">
						<div class="price">
							{{ $product->price + 0 }} €
						</div>
						<div class="col js_actions text-right">
							<div class="js_actions_add {{ $cart->getCountOf($product->id) ? 'd-none' : '' }}">
								<button class="js_cart_add btn btn-sm btn-primary" data-url="{{ route('shop.cart.add', ['productId' => $product->id]) }}">Add to cart</button>
							</div>
							<div class="js_actions_change {{ $cart->getCountOf($product->id) ? '' : 'd-none' }}">
								<button class="js_cart_remove btn btn-sm btn-primary" data-url="{{ route('shop.cart.remove', ['productId' => $product->id]) }}">-</button>
								<span class="js_count">{{ $cart->getCountOf($product->id) }}</span>
								<button class="js_cart_add btn btn-sm btn-primary" data-url="{{ route('shop.cart.add', ['productId' => $product->id]) }}">+</button>
								<a href="{{ route('shop.cart') }}">Checkout</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col col-12 description">
							{{ $product->description }}
						</div>
					</div>
				</article>
			</div>
		@endforeach
	</section>
@endsection

@section('product_cart')
	<a class="product_cart my-2 my-sm-0" href="{{ route('shop.cart') }}">Cart</a>
@endsection
