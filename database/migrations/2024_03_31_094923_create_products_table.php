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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('category', ['RF Premium Series', 'OD Series', 'Aksesoris'])->nullable();
            $table->string('name')->nullable();
            $table->enum('profile', ['doff', 'translucent'])->nullable();
            $table->bigInteger('effective_length')->nullable();
            $table->bigInteger('effective_width')->nullable();
            $table->enum('calculated', ['proof', 'upvc', 'accessories', 'pieces'])->nullable();
            $table->bigInteger('price')->nullable();
            $table->enum('price_unit', ['M', 'Lembar', '40 pcs'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
