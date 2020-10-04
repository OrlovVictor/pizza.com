@extends('layouts.app')
<?php /** @var \App\ProductCart $cart */ ?>

@section('title', 'cart')

@section('css')
	<link href="/css/product/shop.css" rel="stylesheet">
@endsection

@section('js')
	<script src="/js/product/shop/cart.js"></script>
@endsection

@section('content')
	<table class="products table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Count</th>
				<th>Total item price</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		@foreach($cart->getItems() as $item)
			<tr>
				<td>{{ $item->getProduct()->name }}</td>
				<td>{{ $item->getProduct()->price }}</td>
				<td>{{ $item->getCount() }}</td>
				<td>{{ 0 + $item->getCount() * $item->getProduct()->price }}</td>
				<td class="actions">

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
