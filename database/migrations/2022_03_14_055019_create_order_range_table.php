<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_range', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained('users')->onDelete('cascade');
            $table->string('initial_order_range')->nullable(true);
             $table->string('last_order_range')->nullable(true);
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
        Schema::dropIfExists('order_range');
    }
}
