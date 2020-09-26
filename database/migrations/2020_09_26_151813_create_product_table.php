<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product', function (Blueprint $table) {
	        $table->engine = 'InnoDB';
            $table->id();
            $table->enum('type', ['pizza']);
	        $table->string('name', 64);
	        $table->string('description', 1024);
	        $table->string('picture', 1024);
	        $table->unsignedDecimal('price', 8, 2)->default(0);
	        $table->unsignedInteger('position')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('product');
    }
}
