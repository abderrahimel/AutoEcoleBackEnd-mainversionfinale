<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitAdminAutoEcolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_admin_auto_ecoles', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable();
            $table->string('nomCategorie')->nullable();
            $table->string('prix')->nullable();
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
            $table->string('carburant')->nullable();
            $table->string('kilometrage')->nullable();
            $table->string('prixPromotion')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('produit_admin_auto_ecoles');
    }
}

