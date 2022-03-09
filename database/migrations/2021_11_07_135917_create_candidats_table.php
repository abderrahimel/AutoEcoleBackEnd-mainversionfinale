<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo')->nullable();
            $table->string('CIN');
            $table->text('lieu_naissance');
            $table->date('date_naissance');
            $table->string('nationalite');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->date('date_insc');
            $table->string('permis');
            $table->text('connaissance');
            $table->text('adresse');
            $table->string('num_dossier');
            $table->string('langue');
            $table->string('type');
            $table->foreignId('moniteur_theorique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('moniteur_pratique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('vehicule_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('nbr_theo');
            $table->integer('nbr_pra');
            $table->double('frais_insc');
            $table->double('frais_heure');
            $table->date('date_dossier');
            $table->double('frais_examen');
            $table->double('avance');
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
        Schema::dropIfExists('candidats');
    }
}
