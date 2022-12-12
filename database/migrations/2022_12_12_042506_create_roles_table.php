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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre del role de usuario');
            $table->boolean('status')->comment('Estado del registro');
            $table->unsignedBigInteger('user_create_id')->comment('Usuario quien crea el registro');
            $table->unsignedBigInteger('user_update_id')->nullable($value = true)->comment('Usuario quien modifica el registro');
            $table->string('ip_create', 15)->comment('Ip desde donde se crea el registro');
            $table->string('ip_update', 15)->nullable($value = true)->comment('Ip desde donde se actualiza el registro');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
