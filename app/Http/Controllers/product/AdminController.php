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

	/**
	 * CRUD: Update product.
	 * @param Request $request
	 * @param int $id
	 * @return array
	 */
	public function update(Request $request, int $id) {
		$product = Product::findOrFail($id);
		$product->fill($request->all(['type', 'name', 'description', 'price']));
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
