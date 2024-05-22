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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date')->nullable();
            $table->enum('category', ['store', 'project', 'e-commerse'])->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('needs')->nullable();
            $table->text('address')->nullable();
            $table->text('store')->nullable();
            $table->text('description')->nullable();
            $table->enum('response', ['no-response', 'going-store-looking-stock', 'store', 'stock-empty-awaiting-stock', 'only-question', 'used-other-product', 'not-yet-development', 'negotiation', 'done'])->nullable();
            // $table->bigInteger('total_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
