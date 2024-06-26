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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('grand-total', 15, 3)->nullable();
            $table->string('payment-method')->nullable();
            $table->string('payment-status')->nullable();
            $table->enum('status',['new','processing','shipped','delivered','canceled'])->default('new');
            $table->string('currency')->nullable();
            $table->decimal('shipping-charge', 15, 3)->nullable();
            $table->string('shipping-method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
