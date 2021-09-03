<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToUserprofilesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::table('userprofiles', function (Blueprint $table) {
			//
			$table->string('fname')->nullable();
			$table->string('fphone')->nullable();
			$table->boolean('fstatus')->default(true);
			$table->string('mname')->nullable();
			$table->string('mphone')->nullable();
			$table->boolean('mstatus')->default(true);
			$table->longText('paddress')->nullable();
			$table->text('arts')->nullable();
			$table->text('sports')->nullable();
			$table->text('organizations')->nullable();
			$table->text('others')->nullable();
		});
	}
	
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::table('userprofiles', function (Blueprint $table) {
			//
		});
	}
}