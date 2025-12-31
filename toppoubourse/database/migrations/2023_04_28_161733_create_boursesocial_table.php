<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boursesocial', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('ine')->unique();
            $table->string('UFR')->nullable();
            $table->string('Licence')->nullable();
            $table->date('date_naissance');
            $table->string('email')->unique();
            $table->string('tel')->nullable();
            $table->binary('photo')->nullable();
            $table->binary('extrait')->nullable();
            $table->binary('certificat_deces')->nullable();
            $table->binary('certificat_egalite_chance')->nullable();
            $table->binary('certificat_indigence')->nullable();
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
        Schema::dropIfExists('boursesocial');
    }
};
