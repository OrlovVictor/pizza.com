<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'American Hottest pizza',
		    'description' => 'Hot yellow Amarillo chili sauce topped with mozzarella, pepperoni and jalapeño peppers',
		    'picture' => '',
		    'price' => 15.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'The Mexican pizza',
		    'description' => 'Spicy Beef, jalapeño peppers, green peppers, onion and red chilli peppers',
		    'picture' => '',
		    'price' => 16.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'Cheese & Tomato pizza',
		    'description' => 'Tomato sauce and mozzarella cheese',
		    'picture' => '',
		    'price' => 17.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'Vegan cheese & Tomato pizza',
		    'description' => 'Tomato sauce and vegan cheese',
		    'picture' => '',
		    'price' => 18.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'The Greek pizza',
		    'description' => 'Feta cheese, Onion, tomatoes, black olives and oregano',
		    'picture' => '',
		    'price' => 19.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'Garden Party pizza',
		    'description' => 'Tomatoes, onions, green peppers, sweetcorn and chestnut mushrooms',
		    'picture' => '',
		    'price' => 20.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'Chili Freak pizza',
		    'description' => 'Hot yellow Amarillo chili sauce, green peppers, red chili peppers, jalapeño peppers and onions',
		    'picture' => '',
		    'price' => 21.00
	    ]);

	    DB::table('product')->insert([
		    'type' => 'pizza',
		    'name' => 'Hawaiian pizza',
		    'description' => 'Ham with juicy pineapple chunks',
		    'picture' => '',
		    'price' => 22.00
	    ]);
    }
}
