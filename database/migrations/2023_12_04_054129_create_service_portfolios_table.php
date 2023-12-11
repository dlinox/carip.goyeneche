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
        Schema::create('service_portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->nullable();
            $table->string('description')->nullable();
            $table->string('guide_name')->nullable();
            $table->string('guide_file')->nullable();
            $table->string('resolution_name')->nullable();
            $table->string('resolution_file')->nullable();
            $table->date('date_published')->nullable();
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_portfolios');
    }
};
