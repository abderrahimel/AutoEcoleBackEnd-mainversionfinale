<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('employe_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('etat_voiture');
            $table->foreignId('fournisseur_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('vehicule_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->date('date_vidange');
            $table->date('date_suivante');
            $table->date('duree_remembring');
            $table->string('km_actuelle');
            $table->string('type_huile');
            $table->string('last_km');
            $table->string('ht');
            $table->string('taux');
            $table->string('ttc');
            $table->string('tva');
            $table->text('description');
            $table->text('filter');
            $table->string('type');
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
        Schema::dropIfExists('controles');
    }
}
