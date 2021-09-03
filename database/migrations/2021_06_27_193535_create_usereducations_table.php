<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsereducationsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('usereducations', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
			$table->integer('level')->nullable();
			$table->string('name')->nullable();
			$table->string('faculty')->nullable();
			$table->string('focus')->nullable();
			$table->integer('semester')->nullable();
			$table->text('address')->nullable();
			$table->year('in')->nullable();
			$table->year('out')->nullable();
			$table->string('certificate')->nullable();
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
		Schema::dropIfExists('usereducations');
	}
}