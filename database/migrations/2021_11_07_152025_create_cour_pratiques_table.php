<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourPratiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cour_pratiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('moniteur_pratique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->date('date');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('permis');
            $table->text('type');
            $table->text('candidat');
            $table->foreignId('vehicule_id')->constrained()
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
        Schema::dropIfExists('cour_pratiques');
    }
}
