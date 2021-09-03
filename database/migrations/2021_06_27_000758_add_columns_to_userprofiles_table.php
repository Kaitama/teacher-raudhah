<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserprofilesTable extends Migration
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
						$table->string('marriage')->default('Belum Menikah');
						$table->string('ktp')->nullable();
						$table->string('npwp')->nullable();
						$table->string('blood')->nullable();
						$table->integer('childnum')->default(1);
						$table->integer('siblings')->default(0);
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