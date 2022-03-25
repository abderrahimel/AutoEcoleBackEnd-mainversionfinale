<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVidangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vidanges', function (Blueprint $table) {
            $table->id();
            $table->double('montant')->nullable();
            $table->boolean('etat')->nullable();
            $table->string('date_vidange')->nullable();
            $table->string('date_prochain_vidange')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('auto_ecole_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('employe_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('vehicule_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('fournisseur_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vidanges');
    }
}
