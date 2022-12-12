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
            $table->id();
            $table->unsignedBigInteger('role_id')->comment('Role del usuario');
            $table->string('firstname')->comment('Nombre del usuario');
            $table->string('lastname')->comment('Apellido del usuario');
            $table->string('email')->unique()->comment('Email del usuario');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->unique()->comment('Username del usuario');
            $table->string('password')->comment('Password del usuario');
            $table->rememberToken();
            $table->boolean('status')->comment('Estado del registro');
            $table->string('ip_create', 15)->comment('Ip desde donde se crea el registro');
            $table->string('ip_update', 15)->nullable($value = true)->comment('Ip desde donde se actualiza el registro');
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
