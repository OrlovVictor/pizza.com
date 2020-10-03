<form method="post" action="{{ $url }}" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label>Product name</label>
		<input name="name" type="text" class="form-control" placeholder="Enter product name" value="{{ isset($product) ? $product->name : "" }}">
	</div>
	<div class="form-group">
		<label>Product type</label>
		<select name="type" class="form-control">
			@foreach ($productTypes as $type)
				<option value="{{ $type }}">{{ $type }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>Product description</label>
		<textarea name="description" class="form-control" minlength="1" placeholder="Enter product description">{{ isset($product) ? $product->description : "" }}</textarea>
	</div>
	<div class="form-group">
		<label>Product price</label>
		<input name="price" type="number" class="form-control" min="0" step="0.01" value="{{ isset($product) ? $product->price : 0.0 }}">
	</div>
	<div class="form-group">
		<div class="custom-file js_upload">
			<input type="file" name="{{ $imageInputName }}" class="custom-file-input">
			<label class="custom-file-label">Select product image</label>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-12 col-md-6 col-lg-4">
			<img class="js_picture" src="{{ $product ? $product->getPictureUrl() : null }}" alt="{{ $product ? $product->picture : null }}" />
		</div>
	</div>
	<button type="submit" class="btn btn-success js_save">Save</button>
</form>
