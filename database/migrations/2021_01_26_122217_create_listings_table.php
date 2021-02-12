<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('country_id');
            $table->string('slug');
            $table->string('from');
            $table->string('to');
            $table->timestamp('departure')->nullable();
            $table->string('type');
            $table->integer('seats')->nullable();
            $table->integer('price')->nullable();
            $table->string('phone');
            $table->text('note')->nullable();
            $table->string('vip')->nullable();
            $table->string('currency')->default('€')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
