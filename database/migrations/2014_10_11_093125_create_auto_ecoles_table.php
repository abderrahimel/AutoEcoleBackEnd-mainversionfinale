<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoEcolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_ecoles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
                  $table->string('etat')->default('en_attente');
                  $table->string('nom_auto_ecole')->nullable();
                  $table->string('telephone')->nullable();
                  $table->string('pays')->nullable();
                  $table->string('ville')->nullable();
                  $table->string('fax')->nullable();
                  $table->string('site_web')->nullable();
                  $table->longText('adresse')->nullable();
                  $table->string('image')->nullable();
                  $table->string('image_rc')->nullable();
                  $table->string('image_cin')->nullable();
                  $table->string('image_agrement')->nullable();
                  $table->string('n_cnss')->nullable();
                  $table->string('ice')->nullable();
                  $table->string('tva')->nullable();
                  $table->string('n_register_de_commerce')->nullable();
                  $table->string('n_compte_bancaire')->nullable();
                  $table->string('n_agrement')->nullable();
                  $table->string('n_patente')->nullable();
                  $table->string('date_autorisation')->nullable();
                  $table->string('date_ouverture')->nullable();
                  $table->string('identification_fiscale')->nullable();
                  $table->string('cin_responsable')->nullable();
                  $table->string('nom_responsable')->nullable();
                  $table->string('prenom_responsable')->nullable();
                  $table->string('tel_responsable')->nullable();
                  $table->longText('adresse_responsable')->nullable();
                  $table->string('contrat')->nullable();
                  $table->timestamps();
                  $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_ecoles');
    }
}
