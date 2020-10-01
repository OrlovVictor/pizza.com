<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\View\View;

class AdminController extends Controller {
	/**
	 * Show all products in a table.
	 * @return View
	 */
	public function index() {
		return view('product.admin.index', ['products' => Product::all()]);
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
