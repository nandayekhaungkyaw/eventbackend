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
        Schema::create('record_orders', function (Blueprint $table) {
            $table->id();
    $table->string('event_title');
    $table->string('ticket_title');
    $table->integer('quantity');
    $table->decimal('total_amount', 10, 2);
    $table->string('phone')->nullable();
$table->string('status')->default('confirmed');
$table->enum('payment_method',["KBZ","AYA","WAVE MONEY", "CB PAY", "MPT PAY", "OK PAY", "K PAY", "E-WALLET","Free"]);
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
        Schema::dropIfExists('record_orders');
    }
};
