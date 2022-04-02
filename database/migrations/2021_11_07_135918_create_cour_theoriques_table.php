<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourTheoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cour_theoriques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('moniteur_theorique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('permis');
            $table->string('date_debut');
            $table->string('date_fin');
            $table->string('date')->nullable();
            $table->string('type');
            $table->text('candidat');
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
        Schema::dropIfExists('cour_theoriques');
    }
}
