@extends('layouts.app')

@section('title', 'products')

@section('css')
	<link href="/css/product/shop.css" rel="stylesheet">
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
						<div class="price">
							{{ $product->price + 0 }} €
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
