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
        Schema::create('tickets', function (Blueprint $table) {
           $table->id();
$table->foreignId('event_id')->constrained()->onDelete('cascade');
$table->string('title');
$table->decimal('amount', 10, 2)->nullable();
$table->integer('available_quantity');
$table->longText('description')->nullable();
$table->date('sale_start_date');
$table->date('sale_end_date');
$table->time('start_time');
$table->time('end_time');
$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
