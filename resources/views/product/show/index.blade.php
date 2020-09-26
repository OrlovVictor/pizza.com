@extends('layouts.app')

@section('title', 'products')

@section('content')
	@foreach ($products as $product)
		<p>This is product {{ $product->id }}</p>
	@endforeach
@endsection
