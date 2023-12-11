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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('paternal_surname', 60);
            $table->string('maternal_surname', 60);
            $table->enum('document_type', ['DNI'])->default('DNI');
            $table->char('document_number', 8)->unique();
            $table->char('registration_code', 8)->unique()->nullable();
            $table->string('photo')->nullable();
            $table->char('phone_number', 9)->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_doctor')->default(true);
            $table->boolean('is_authority')->default(false);
            $table->unsignedBigInteger('specialty_id')->nullable();
            $table->foreign('specialty_id')->references('id')->on('specialties')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
