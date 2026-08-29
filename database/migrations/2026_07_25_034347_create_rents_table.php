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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id(); // Rent ID

            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('equipment_id')
                  ->constrained('equipments')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->date('rent_date');
            $table->date('return_date');

            $table->enum('status', [
                'Pending',
                'Rented',
                'Returned',
                'Late',
                'Cancelled'
            ])->default('Pending');

            $table->timestamps();

            $table->index('rent_date');
            $table->index('return_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};