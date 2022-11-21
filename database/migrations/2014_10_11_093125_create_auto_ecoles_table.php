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
                  $table->string('nom_auto_ecole');
                  $table->string('telephone');
                  $table->string('pays');
                  $table->string('ville');
                  $table->string('fax')->nullable();//not required
                  $table->string('site_web')->nullable();//not required
                  $table->longText('adresse')->nullable(); //not required
                  $table->string('image');
                  $table->string('image_rc');
                  $table->string('image_cin');
                  $table->string('image_agrement');
                  $table->string('n_cnss');
                  $table->string('ice');
                  $table->string('tva');
                  $table->string('n_register_de_commerce');
                  $table->string('n_compte_bancaire');
                  $table->string('n_agrement');
                  $table->string('n_patente');
                  $table->string('date_autorisation');
                  $table->string('date_ouverture');
                  $table->string('identification_fiscale');
                  $table->string('cin_responsable');
                  $table->string('nom_responsable');
                  $table->string('prenom_responsable');
                  $table->string('tel_responsable');
                  $table->longText('adresse_responsable')->nullable();//not required
                  $table->string('contrat')->nullable();//not required
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