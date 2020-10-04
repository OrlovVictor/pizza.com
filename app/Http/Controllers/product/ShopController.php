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
		$cart = new ProductCart();
		return view('product.shop.index', ['products' => Product::all(), 'cart' => $cart]);
	}

	/**
	 * Show product cart page.
	 * @return View
	 */
	public function cart() {
		$cart = new ProductCart();
		return view('product.shop.cart', ['cart' => $cart]);
	}

	/**
	 * Add product into the cart.
	 * @param int $productId
	 * @return array[]
	 */
	public function addProduct(int $productId) {
		$cart = new ProductCart();
		return ['count' => $cart->addProduct($productId)];
	}

	/**
	 * Remove product from the cart.
	 * @param int $productId
	 * @return array[]
	 */
	public function removeProduct(int $productId) {
		$cart = new ProductCart();
		return ['count' => $cart->removeProduct($productId)];
	}

	/**
	 * Returns cart items as array.
	 * @return array[]
	 */
	public function getCartItems() {
		$cart = new ProductCart();
		return $cart->toArray();
	}
}
