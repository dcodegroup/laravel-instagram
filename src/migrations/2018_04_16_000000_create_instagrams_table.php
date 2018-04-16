<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instagrams', function (Blueprint $table) {
			$table->increments('id');
			$table->string('client_id');
			$table->string('client_secret');
			$table->string('redirect_uri');

			$table->string('code')->nullable();
			$table->string('access_token')->nullable();

			$table->unsignedInteger('user_id');

			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('instagrams');
	}
}
