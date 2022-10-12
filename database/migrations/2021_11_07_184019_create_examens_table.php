<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('candidat_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('moniteur_pratique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('categorie');
            $table->date('date_examen');
            $table->date('date_depot');
            $table->string('etat_1')->default('en_attente');
            $table->string('date_etat1')->nullable();
            $table->string('etat_2')->default('en_attente');
            $table->string('date_etat2')->nullable();
            $table->string('note1')->default(-1);
            $table->string('date_note1')->nullable();
            $table->string('note2')->default(-1);
            $table->string('date_note2')->nullable();
            $table->boolean('resultat')->default(-1);
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
        Schema::dropIfExists('examens');
    }
}
