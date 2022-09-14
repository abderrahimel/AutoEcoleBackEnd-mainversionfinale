<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenceTheoriqueMoniteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absence_theorique_moniteurs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('auto_ecole_id')->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreignId('moniteur_theorique_id')->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->string('type_absence');
                $table->string('date_debut');
                $table->string('date_fin');
                $table->text('remarque')->nullable();
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
        Schema::dropIfExists('absence_theorique_moniteurs');
    }
}
