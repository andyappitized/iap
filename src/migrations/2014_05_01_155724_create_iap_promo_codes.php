<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIapPromoCodes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iap_promo_codes', function(Blueprint $table){
			$table->increments('id');
			$table->string('code');
			$table->string('product_key')->index();
			$table->boolean('consumable');
			$table->integer('quantity');
			$table->date('expires');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('iap_promo_codes');
	}

}
