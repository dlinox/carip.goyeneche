<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('institutional_information', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('description');
            $table->string('address', 180); //direccion
            $table->char('phone', 9); //telefono
            $table->string('email', 120); //correo
            $table->text('mission');//mision
            $table->text('vision');//vision
            $table->string('organigram')->nullable(); //imagen organigrama
            $table->string('parties_table', 120)->nullable(); //mesas de partes
            $table->char('ruc', 11)->nullable(); //ruc
            $table->text('about_us')->nullable(); //nosotros
            $table->text('values')->nullable();//valores
            $table->text('motto')->nullable();//lema
            $table->text('history')->nullable(); //historia
            $table->text('logo')->nullable(); //logo
            $table->text('favicon')->nullable(); //favicon
            $table->text('facebook')->nullable(); //otra tabla  redes sociales
            $table->text('twitter')->nullable(); //otra tabla   redes
            $table->text('instagram')->nullable(); //otra tabla redes
            $table->text('youtube')->nullable(); //otra tabla   redes
            $table->text('whatsapp')->nullable(); //otra tabla  redes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutional_information');
    }
};
