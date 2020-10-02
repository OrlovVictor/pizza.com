<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller {
	/**
	 * Show all products in a table.
	 * @return View
	 */
	public function index() {
		return view('product.admin.index', [
			'products' => Product::all(),
			'productTypes' => Product::getTypes()
		]);
	}

	public function update(Request $request, int $id) {
		$product = Product::findOrFail($id);
		$input = [];
		foreach (['type', 'name', 'description', 'price'] as $key) {
			$value = $request->input($key, null);
			if ($value !== null) {
				$input[$key] = $key === 'price' ? floatval($value) : $value;
			}
		}
		$product->fill($input);
		$product->save();
		return ['result' => true];
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
}
