<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
           
            $table->string('matricule');
            $table->string('type');
            $table->string('marque');
            $table->string('modele');
            $table->string('categorie');
            $table->string('date_visite')->nullable();
            $table->string('date_prochain_visite')->nullable();
            $table->string('fourniseur');
            $table->string('date_vidange')->nullable();
            $table->string('date_prochain_vidange')->nullable();
            $table->string('date_assurance')->nullable();
            $table->string('date_expiration_assurance')->nullable();
            $table->text('carte_grise');
            $table->text('vignette');
            $table->text('assurance');
            $table->text('visite');
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
        Schema::dropIfExists('vehicules');
    }
}
