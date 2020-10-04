<?php
namespace App;

use Illuminate\Support\Arr;

class ProductCart {
	const STORE_KEY = 'product_cart';

	/** @var ProductCartItem[] $items */
	protected $items = [];

	/**
	 * ProductCart constructor.
	 */
	public function __construct() {
		$this->load();
	}

	/**
	 * Returns array of cart items.
	 * @return array[]
	 */
	public function toArray() {
		return array_map(function(ProductCartItem $item) { return $item->toArray(); }, array_values($this->items));
	}

	/**
	 * Add one more product into the cart.
	 * @param int $productId
	 * @return $this
	 */
	public function addProduct(int $productId) {
		if (array_key_exists($productId, $this->items)) {
			$this->items[$productId]->addOne();
		} else {
			$this->items[$productId] = new ProductCartItem($productId, 1);
		}
		$this->store();
		return $this;
	}

	/**
	 * Add one more product into the cart.
	 * @param int $productId
	 * @return $this
	 */
	public function removeProduct(int $productId) {
		if (array_key_exists($productId, $this->items)) {
			$this->items[$productId]->removeOne();
			if ($this->items[$productId]->isEmpty()) {
				unset($this->items[$productId]);
			}
		}
		$this->store();
		return $this;
	}

	/**
	 * Load cart items from the storage.
	 * @return bool
	 */
	protected function load() {
		$storedItems = session(self::STORE_KEY, []);
		if (!is_array($storedItems)) { return false; }
		foreach ($storedItems as $itemArray) {
			$productId = intval(Arr::get($itemArray, 'productId', 0));
			$count = intval(Arr::get($itemArray, 'count', 0));
			$this->items[$productId] = new ProductCartItem($productId, $count);
		}
		return true;
	}

	/**
	 * Put cart items into the storage.
	 * @return bool
	 */
	protected function store() {
		$storedItems = array_map(function(ProductCartItem $item) { return $item->toArray(['productId', 'count']); }, $this->items);
		session([self::STORE_KEY => $storedItems]);
		return true;
	}
}
