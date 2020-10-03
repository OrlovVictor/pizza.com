<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model {
	/**
	 * The table associated with the model.
	 * @var string
	 */
	protected $table = 'product';

	/**
	 * Indicates if the model should be timestamped.
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The model's default values for attributes.
	 * @var array
	 */
	protected $attributes = [
		'picture' => '',
		'price' => 0.0,
		'position' => 0,
	];

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = ['type', 'name', 'description', 'price'];

	/**
	 * Mutator: set product price.
	 * @param $value
	 */
	public function setPriceAttribute($value) {
		$this->attributes['price'] = round(floatval($value), 2);
	}

	/**
	 * Returns product picture URL.
	 * @return string|null
	 */
	public function getPictureUrl() {
		return $this->picture ? Storage::url('product/picture/'.$this->picture) : null;
	}

	/**
	 * Returns allowed product types.
	 * @return array
	 */
	public static function getTypes(): array {
		return ['pizza'];
	}
}
