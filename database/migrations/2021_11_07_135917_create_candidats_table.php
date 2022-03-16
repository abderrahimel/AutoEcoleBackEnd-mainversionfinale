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
                  $table->string('cin')->nullable();
                  $table->string('date_inscription')->nullable();
                  $table->string('numero_contrat')->nullable();
                  $table->string('ref_web')->nullable();
                  $table->string('nom_fr')->nullable();
                  $table->string('prenom_fr')->nullable();
                  $table->string('nom_ar')->nullable();
                  $table->string('prenom_ar')->nullable();
                  $table->string('date_naissance')->nullable();
                  $table->longText('lieu_naissance')->nullable();
                  $table->longText('adresse_fr')->nullable();
                  $table->longText('adresse_ar')->nullable();
                  $table->string('telephone')->nullable();
                  $table->string('email')->nullable();
                  $table->string('profession')->nullable();
                  $table->string('langue')->nullable();
                  $table->string('image')->nullable();
                  $table->string('date_fin_contrat')->nullable();
                  $table->string('categorie_demandee')->nullable();
                  $table->integer('nbr_heure_pratique')->nullable();
                  $table->integer('nbr_heure_theorique')->nullable();
                  $table->string('possede_permis')->nullable();
                  $table->string('date_obtention')->nullable();
                  $table->longText('lieu_obtention_fr')->nullable();
                  $table->longText('lieu_obtention_ar')->nullable();
                  $table->double('montant')->nullable();
                  $table->string('pcn')->nullable();
                  $table->string('categorie')->nullable();
                  $table->longText('observations')->nullable();
                  $table->boolean('actif')->default(1);
            $table->foreignId('moniteur_theorique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('moniteur_pratique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('candidats');
    }
}
