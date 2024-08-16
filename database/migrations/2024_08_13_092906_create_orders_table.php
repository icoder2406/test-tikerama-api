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
            // $table->id();
            $table->id('order_id')->comment(' Identifiant unique de la commande');
            $table->string('order_number', 50)->comment('Numéro de la commande.');
            $table->unsignedBigInteger('order_event_id')->nullable()->comment('Identifiant de l’événement associé');
            $table->foreign('order_event_id')->references('event_id')->on('events')->nullOnDelete();
            $table->mediumInteger('order_price')->comment('Prix total de la commande.');
            $table->string('order_type', 50)->comment('Type de la commande.');
            $table->string('order_payment', 100)->comment(' Mode de paiement de la commande.');
            $table->text('order_info')->comment('Informations supplémentaires sur la commande.');
            $table->timestamp('order_created_on');
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
