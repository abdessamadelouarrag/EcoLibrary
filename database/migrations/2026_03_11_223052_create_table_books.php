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
        Schema::create('table_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->string('description')->nullable();
            $table->integer('total_quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_books');
    }
};
