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
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giver_id')->constrained('users');
            $table->foreignId('receiver_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->enum('status', ['pending', 'completed', 'paid_forward'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acts');
    }
};
