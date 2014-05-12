<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIapProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iap_products', function(Blueprint $table){
			$table->string('product_key')->unique();
			$table->primary('product_key');
			$table->string('product_name');
			$table->boolean('consumable');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('iap_products');
	}

}
