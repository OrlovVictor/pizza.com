<?php
namespace App;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model {
	use UploadTrait;

	const IMAGE_INPUT_NAME = 'product_image';
	const IMAGE_DIRECTORY = 'product/picture';

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
		return $this->picture ? Storage::url(self::IMAGE_DIRECTORY.'/'.$this->picture) : null;
	}

	/**
	 * Returns allowed product types.
	 * @return array
	 */
	public static function getTypes(): array {
		return ['pizza'];
	}

	/**
	 * Save product image in the filesystem.
	 * @param Request $request
	 * @return bool
	 */
	public function saveImage(Request $request) {
		// Validation: require image file, specify maximum size in kilobytes.
		$request->validate([
			Product::IMAGE_INPUT_NAME => ['mimes:jpeg,png', 'max:1024']
		]);
		// Get image file.
		$image = $request->file(Product::IMAGE_INPUT_NAME);
		if ($image) {
			// Make an image name based on product name, date and time.
			$name = sprintf('%s_%s', Str::slug($request->input('name'), '_'), date('Ymd_His'));
			// Save uploaded image.
			$path = $this->storeUploadedFile($image, 'public', self::IMAGE_DIRECTORY, $name);
			// Save image file name in the property.
			$this->picture = basename($path);
			// Return result: file is saved.
			return true;
		}
		// Return default value.
		return false;
	}
}
