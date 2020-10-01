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
				<th>actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->type }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->price }}</td>
					<td>
						<!-- Delete button. -->
						<a class="btn btn-sm btn-danger" target="_blank" href="{{ route('admin.product.delete', ['id' => $product->id]) }}">Delete</a>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
