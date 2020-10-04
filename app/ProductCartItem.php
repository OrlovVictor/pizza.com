<?php
namespace App;

class ProductCartItem {
	/** @var int $productId */
	protected $productId;
	/** @var Product $product */
	protected $product;
	/** @var int $count */
	protected $count;

	/**
	 * ProductCartItem constructor.
	 * @param int $productId
	 * @param int $count
	 */
	public function __construct(int $productId, int $count) {
		$this->productId = $productId;
		$this->count = $count;
		if ($this->count <= 0) {
			throw new \RuntimeException(sprintf('Unable to create cart item: count should be positive number.'));
		}
		$this->product = Product::findOrFail($this->productId);
	}

	/**
	 * Increases item's count.
	 * @return bool
	 */
	public function addOne() {
		++$this->count;
		return true;
	}

	/**
	 * Decreases item's count.
	 * @return bool
	 */
	public function removeOne() {
		if ($this->count > 0) { --$this->count; }
		return true;
	}

	/**
	 * Returns true if count equals zero.
	 * @return bool
	 */
	public function isEmpty() { return $this->count === 0; }

	/**
	 * Returns array representation of the object.
	 * @param array $fields
	 * @return array
	 */
	public function toArray(array $fields = ['product', 'count']) {
		$fields = array_intersect(['product', 'productId', 'count'], $fields);
		$result = [];
		foreach ($fields as $field) { $result[$field] = $this->{$field}; }
		return $result;
	}

	public function __toString() {
		return json_encode($this->toArray());
	}
}
