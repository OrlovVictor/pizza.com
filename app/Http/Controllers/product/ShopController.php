<?php
namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCart;
use Illuminate\View\View;

class ShopController extends Controller {
	/**
	 * Show all products as a list of product cards.
	 * @return View
	 */
	public function index() {
		return view('product.shop.index', ['products' => Product::all()]);
	}

	/**
	 * Add product into the cart.
	 * @param int $productId
	 * @return array[]
	 */
	public function addProduct(int $productId) {
		$cart = new ProductCart();
		return $cart->addProduct($productId)->toArray();
	}

	/**
	 * Remove product from the cart.
	 * @param int $productId
	 * @return array[]
	 */
	public function removeProduct(int $productId) {
		$cart = new ProductCart();
		return $cart->removeProduct($productId)->toArray();
	}

	/**
	 * Returns cart items as array.
	 * @return array[]
	 */
	public function getCart() {
		$cart = new ProductCart();
		return $cart->toArray();
	}
}
