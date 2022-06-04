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
            $table->string('titre');
            $table->string('nomCategorie');
            $table->string('prix');
            $table->string('marque');
            $table->string('modele');
            $table->string('carburant');
            $table->string('kilometrage');
            $table->string('prixPromotion');
            $table->string('description');
            $table->string('image');
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
