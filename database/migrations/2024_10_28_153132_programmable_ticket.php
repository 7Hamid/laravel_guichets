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
        Schema::create('programmable_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('adresse');
            $table->string('localisation');
            $table->string('categorie');
            $table->string('phone');
            $table->decimal('prix', 8, 2);
            $table->decimal('prix_vip', 8, 2)->nullable();
            $table->string('devise');
            $table->date('event_date');
            $table->time('event_time');
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('programmable_tickets');
    }
};
