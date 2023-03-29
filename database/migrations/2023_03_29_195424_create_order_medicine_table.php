<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicines_orders', function (Blueprint $table) {
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("medicine_id");
            $table->primary(['order_id', 'medicine_id']);
            $table->integer("quantity");
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines_orders_');
    }
};
