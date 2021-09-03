<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserpartnersTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('userpartners', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
			$table->string('name')->nullable();
			$table->string('phone')->nullable();
			$table->string('education')->nullable();
			$table->string('work')->nullable();
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
		Schema::dropIfExists('userpartners');
	}
}