<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserpermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userpermits', function (Blueprint $table) {
            $table->id();
						$table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
						$table->integer('category');
						$table->text('description')->nullable();
						$table->timestamp('signed_at');
						$table->timestamp('started_at');
						$table->timestamp('ended_at');
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
        Schema::dropIfExists('userpermits');
    }
}