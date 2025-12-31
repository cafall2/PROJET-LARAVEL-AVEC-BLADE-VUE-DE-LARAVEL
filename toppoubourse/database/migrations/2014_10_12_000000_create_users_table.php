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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('ine')->nullable();
            $table->string('UFR')->nullable();
            $table->string('Licence')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->unique();
            $table->binary('photo')->nullable();
            $table->string('password');
            $table->boolean('admin')->default(true);
            $table->boolean('enabled')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
