<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaimentCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {      
        Schema::create('paiment_candidats', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('montant');
            $table->string('nom_banque')->nullable();
            $table->text('image')->nullable();
            $table->string('type_p');
            $table->string('numero')->nullable();
            $table->string('remarque')->nullable();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('candidat_id')->constrained()
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
        Schema::dropIfExists('paiment_candidats');
    }
}
