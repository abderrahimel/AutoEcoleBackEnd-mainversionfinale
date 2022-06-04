<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade') 
                  ->onDelete('cascade');
            $table->foreignId('candidat_id')->constrained()  
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); 
            $table->foreignId('produit_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('prixUnitaire');
            $table->string('prixTotale');
            $table->string('quantiteDisponible');
            $table->string('quantite');
            $table->string('date');
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
        Schema::dropIfExists('ventes');
    }
}
