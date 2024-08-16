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
        Schema::create('order_intents', function (Blueprint $table) {
            // $table->id();
            $table->id('order_intent_id')->comment(' Identifiant unique de l’intention de commande');
            $table->mediumInteger('order_intent_price')->comment('Prix total de l’intention de commande.');
            $table->string('order_intent_type', 50)->comment("Type de l'intention de commande.");
            $table->string('user_email', 100)->comment("Email de l'utilisateur.");
            $table->string('user_phone', 20)->comment("Téléphone de l'utilisateur.");
            $table->dateTime('expiration_date')->comment("Date d’expiration de l'intention de commande.");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_intents');
    }
};
