@extends('layouts.app')

@section('title', 'products')

@section('css')
	<link href="/css/product/show.css" rel="stylesheet">
@endsection

@section('content')
	<section class="products">
		@foreach($products as $product)
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
		@endforeach
	</section>
@endsection
