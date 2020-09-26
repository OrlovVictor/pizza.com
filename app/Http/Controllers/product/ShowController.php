<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\View\View;

class ShowController extends Controller {
	/**
	 * Show all products.
	 * @return View
	 */
	public function index() {
		return view('product.show.index', ['products' => Product::all()]);
	}
}
