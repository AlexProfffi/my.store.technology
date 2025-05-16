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
        Schema::create('movie_rent', function (Blueprint $table) {
            $table->uuid('instance_id');
            $table->foreignId('rent_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('days');
            $table->primary(['instance_id', 'rent_id', 'movie_id']);
            $table->timestamps();
//            $table->timestamp('rented_at'); // for order
//            $table->timestamp('returned_at')->nullable(); // for order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_rent');
    }
};
