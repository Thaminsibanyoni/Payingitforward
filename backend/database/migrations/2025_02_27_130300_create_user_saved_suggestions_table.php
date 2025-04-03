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
        if (!Schema::hasTable('user_saved_suggestions')) {
            Schema::create('user_saved_suggestions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('suggestion_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                
                // Ensure a user can only save a suggestion once
                $table->unique(['user_id', 'suggestion_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_saved_suggestions');
    }
};
