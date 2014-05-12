<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConsumablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_consumables', function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('product_key')->index();
			$table->integer('quantity');

			$table->unique(array('user_id','product_key'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_consumables');
	}

}
