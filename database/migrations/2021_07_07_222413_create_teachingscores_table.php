<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachingscores', function (Blueprint $table) {
            $table->id();
						$table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
						$table->timestamp('scored_at');
						$table->bigInteger('c1')->default(0);
						$table->bigInteger('c2')->default(0);
						$table->bigInteger('c3')->default(0);
						$table->bigInteger('c4')->default(0);
						$table->bigInteger('c5')->default(0);
						$table->bigInteger('c6')->default(0);
						$table->text('description')->nullable();
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
        Schema::dropIfExists('teachingscores');
    }
}