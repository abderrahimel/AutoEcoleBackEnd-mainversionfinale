<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourPratiquePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cour_pratique_presences', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('heure_debut');
            $table->string('heure_fin');
            $table->string('categorie');
            $table->text('candidat');
            $table->text('presence');
            $table->foreignId('cour_pratique_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('auto_ecole_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('moniteur_pratique_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('cour_pratique_presences');
    }
}
