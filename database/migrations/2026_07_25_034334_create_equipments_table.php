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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id(); // Equipment ID
            $table->string('name');
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('picture')->nullable(); // Store image filename/path
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->timestamps();

            $table->index('name');
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};