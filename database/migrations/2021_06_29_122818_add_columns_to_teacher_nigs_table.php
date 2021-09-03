<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTeacherNigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_nigs', function (Blueprint $table) {
            //
						$table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->before('nig');
						$table->dropColumn('account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_nigs', function (Blueprint $table) {
            //
        });
    }
}