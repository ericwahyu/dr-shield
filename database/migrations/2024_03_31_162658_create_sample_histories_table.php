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
        Schema::create('sample_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sample_id')->nullable();
            $table->enum('type', ['entry','exit'])->nullable();
            $table->bigInteger('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_histories');
    }
};
