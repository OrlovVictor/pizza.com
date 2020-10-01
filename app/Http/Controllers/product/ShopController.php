<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\View\View;

class ShopController extends Controller {
	/**
	 * Show all products as a list of product cards.
	 * @return View
	 */
	public function index() {
		return view('product.shop.index', ['products' => Product::all()]);
	}
}
