<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('categorie_depence_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); 
            $table->foreignId('employe_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->date('date');
            $table->double('montant');
            $table->text('remarques');
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
        Schema::dropIfExists('depences');
    }
}
