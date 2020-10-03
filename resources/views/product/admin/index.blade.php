@extends('layouts.app')

@section('title', 'products:admin')

@section('css')
	<link href="/css/product/admin.css" rel="stylesheet">
@endsection

@section('js')
	<script src="/js/product/admin/crud.js"></script>
@endsection

@section('content')
	<div class="row mb-2">
		<div class="js_create col col-12">
			<!-- Button for opening creation form. -->
			<a class="btn btn-primary" data-toggle="collapse" href="#product_create" role="button">Add product</a>
			<div class="collapse" id="product_create">
				@include('product.admin.create_update', [ 'product' => null, 'url' => route('admin.product.create') ])
			</div>
		</div>
	</div>
	<table class="products table">
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
					<td class="actions">
						<!-- Edit button. -->
						<a class="btn btn-sm btn-info" data-toggle="collapse" href="#product_{{ $product->id }}" role="button">Edit</a>
						<!-- Delete button. -->
						<a class="btn btn-sm btn-danger"
						   data-toggle="modal"
						   data-target="#js_delete_confirmation"
						   data-item-name="{{ $product->name }}"
						   data-url="{{ route('admin.product.delete', ['id' => $product->id]) }}">Delete</a>
					</td>
				</tr>
				<tr class="js_edit" data-id="{{ $product->id }}">
					<td colspan="100">
						<div class="collapse" id="product_{{ $product->id }}">
							@include('product.admin.create_update', [ 'product' => $product, 'url' => route('admin.product.update', ['id' => $product->id]) ])
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<!-- Modal window: delete confirmation. -->
	<div class="modal fade" id="js_delete_confirmation" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Please confirm deleting</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="js_item_name"></div>
					Are you sure to delete this item?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger js_delete">Delete</button>
				</div>
			</div>
		</div>
	</div>
@endsection
