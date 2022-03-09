<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidat_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('CIN');
            $table->string('langue');
            $table->string('type');
            $table->foreignId('moniteur_theorique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('moniteur_pratique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->double('prix');
            $table->double('prix_inscription');
            $table->float('heures_pratiques');
            $table->float('heures_theoriques');
            $table->date('date_dossier');
            $table->float('prix_examen');
            $table->float('avance');
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
        Schema::dropIfExists('dossiers');
    }
}
