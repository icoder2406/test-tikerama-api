<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            // $table->id();
            $table->id('ticket_type_id')->comment(' Identifiant unique du type de ticket.');
            $table->unsignedBigInteger('ticket_type_event_id')->nullable()->comment('Identifiant de l’événement associé');
            $table->foreign('ticket_type_event_id')->references('event_id')->on('events')->nullOnDelete();
            $table->string('ticket_type_name', 50)->comment('Nom du type de ticket, par exemple Grand Public,
 VIP, Premium, etc.');
            $table->mediumInteger('ticket_type_price')->comment('Prix du type de ticket.');
            $table->integer('ticket_type_quantity')->comment('Quantité totale de tickets disponibles, tient compte des
 intentions de paiement');
            $table->integer('ticket_type_real_quantity')->comment('Quantité réelle de tickets disponibles, mise à jour
 une fois l’intention de paiement validée.');

            $table->integer('ticket_type_total_quantity')->comment('Quantité totale de tickets (incluant les tickets
 vendus et non encore vendus).');

            $table->mediumText('ticket_type_description')->nullable()->comment(' Description du type de ticket, par exemple :
 Place assise en première rangée, 1 boisson offerte.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
