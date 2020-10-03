<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller {
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
		$product->saveImage($request);
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
		/** @var Product $product */
		$product = Product::findOrFail($id);
		$product->fill($request->all(['type', 'name', 'description', 'price']));
		$product->saveImage($request);
		$product->save();
		return ['result' => true, 'pictureUrl' => $product->getPictureUrl()];
	}

	/**
	 * CRUD: Delete product.
	 * @param int $id
	 * @return array
	 * @throws \Exception
	 */
	public function delete(int $id) {
		/** @var Product $product */
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
}
