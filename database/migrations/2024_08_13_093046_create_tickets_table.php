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
            // $table->id();
            $table->id('ticket_id');
            $table->unsignedBigInteger('ticket_event_id')->nullable();
            $table->foreign('ticket_event_id')->references('event_id')->on('events')->cascadeOnDelete();
            $table->string('ticket_email', 255);
            $table->string('ticket_phone', 20);
            $table->mediumInteger('ticket_price');
            $table->unsignedBigInteger('ticket_order_id')->nullable();
            $table->foreign('ticket_order_id')->references('order_id')->on('orders')->nullOnDelete();
            $table->string('ticket_key', 100);
            $table->unsignedBigInteger('ticket_ticket_type_id')->nullable();
            $table->foreign('ticket_ticket_type_id')->references('ticket_type_id')->on('ticket_types')->nullOnDelete();
            $table->enum('ticket_status', ['active', 'validated', 'expired', 'cancelled']);
            $table->timestamp('ticket_created_on');
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
