<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
