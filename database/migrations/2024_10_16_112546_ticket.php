<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('adresse');
            $table->string('localisation');
            $table->string('categorie');
            $table->decimal('prix', 10, 2);
            $table->decimal('prix_vip', 10, 2);
            $table->string('phone');
            $table->string('devise');
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->string('image')->nullable();
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
