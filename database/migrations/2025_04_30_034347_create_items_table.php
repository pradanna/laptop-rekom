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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('processor');
            $table->string('ram');
            $table->string('storage');
            $table->string('gpu')->nullable();
            $table->integer('price');
            $table->string('condition')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('keyword')->nullable(); // untuk Content-Based Filtering
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
