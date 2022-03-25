<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_ecole_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin');
            $table->string('role');
            $table->date('date_naissance');
            $table->text('lieu_naissance');
            $table->string('email');
            $table->string('type');
            $table->string('telephone');
            $table->date('date_embauche');
            $table->string('capn');
            $table->text('adresse');
            $table->text('conduire');
            $table->text('observations');
            $table->timestamps();
        });

            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');
    }
}
