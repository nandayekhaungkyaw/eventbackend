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

            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->string('phone')->nullable();
$table->enum('status', ['pending',  'cancelled','confirmed', 'paid'])->default('pending');
$table->enum('payment_method',["KBZ","AYA","WAVE MONEY", "CB PAY", "MPT PAY", "OK PAY", "K PAY", "E-WALLET","Free"])->default('KBZ');
$table->string('transaction_id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('confirmed_email');

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
