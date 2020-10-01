@extends('layouts.app')

@section('title', 'products:admin')

@section('css')
	<link href="/css/product/admin.css" rel="stylesheet">
@endsection

@section('content')
	<table class="products table table-striped">
		<thead>
			<tr>
				<th>id</th>
				<th>type</th>
				<th>name</th>
				<th>price</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->type }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->price }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
