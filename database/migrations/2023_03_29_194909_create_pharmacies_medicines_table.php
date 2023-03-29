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
        Schema::create('pharmacies_medicines', function (Blueprint $table) {
            $table->unsignedBigInteger("pharmacy_id");
            $table->unsignedBigInteger("medicine_id");
            $table->primary(['pharmacy_id', 'medicine_id']);
            $table->integer("quantity");
            $table->timestamps();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
            $table->foreign('medicine_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies_medicines');
    }
};
