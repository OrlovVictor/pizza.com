<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller {
	use UploadTrait;

	/**
	 * Show all products in a table.
	 * @return View
	 */
	public function index() {
		return view('product.admin.index', [
			'products' => Product::all(),
			'productTypes' => Product::getTypes(),
			'imageInputName' => Product::IMAGE_INPUT_NAME
		]);
	}

	/**
	 * CRUD: Update product.
	 * @param Request $request
	 * @return array
	 */
	public function create(Request $request) {
		$this->validateRequest($request, [ Product::IMAGE_INPUT_NAME => ['required'] ]);
		$product = new Product();
		$product->fill($request->all(['type', 'name', 'description', 'price']));
		$imageFileName = $this->saveImage($request);
		if ($imageFileName) { $product->picture = $imageFileName; }
		$product->save();
		return ['result' => true, 'product' => $product, 'pictureUrl' => $product->getPictureUrl()];
	}

	/**
	 * CRUD: Update product.
	 * @param Request $request
	 * @param int $id
	 * @return array
	 */
	public function update(Request $request, int $id) {
		$this->validateRequest($request);
		$product = Product::findOrFail($id);
		$product->fill($request->all(['type', 'name', 'description', 'price']));
		$imageFileName = $this->saveImage($request);
		if ($imageFileName) { $product->picture = $imageFileName; }
		$product->save();
		return ['result' => true, 'pictureUrl' => $product->getPictureUrl()];
	}

	/**
	 * CRUD: Delete product.
	 * @param int $id
	 * @return array
	 */
	public function delete(int $id) {
		$product = Product::findOrFail($id);
		$product->delete();
		return ['result' => true];
	}

	/**
	 * Validate request with product data.
	 * @param Request $request
	 * @param array $optionalRules
	 */
	protected function validateRequest(Request $request, array $optionalRules = []) {
		$rules = [
			'type' => ['required', Rule::in(Product::getTypes())],
			'name' => ['required', 'string', 'max:64'],
			'description' => ['required', 'string', 'max:1024'],
			'price' => ['required', 'numeric', 'min:0'],
		];
		$rules = array_merge($rules, $optionalRules);
		$request->validate($rules);
	}

	/**
	 * Save product image in the filesystem.
	 * @param Request $request
	 * @return string|null
	 */
	protected function saveImage(Request $request) {
		// Validation: require image file, specify maximum size in kilobytes.
		$request->validate([
			Product::IMAGE_INPUT_NAME => ['mimes:jpeg,png', 'max:1024']
		]);
		// Get image file.
		$image = $request->file(Product::IMAGE_INPUT_NAME);
		if ($image instanceof UploadedFile) {
			// Make an image name based on product name, date and time.
			$name = sprintf('%s_%s', Str::slug($request->input('name'), '_'), date('Ymd_His'));
			// Define folder path.
			$folder = '/product/picture';
			// Save uploaded image.
			$path = $this->storeUploadedFile($image, 'public', $folder, $name);
			// Return image name with extension.
			return basename($path);
		}
		// Return default value.
		return null;
	}
}
