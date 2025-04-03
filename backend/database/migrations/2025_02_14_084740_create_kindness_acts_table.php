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
        Schema::create('kindness_acts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->string('location')->nullable();
            $table->date('date');
            $table->string('recipient_type')->default('anonymous'); // anonymous or known
            $table->boolean('is_public')->default(true);
            $table->boolean('allow_verification')->default(true);
            $table->string('image_path')->nullable();
            $table->json('tags')->nullable();
            $table->text('impact_description')->nullable();
            $table->enum('expected_impact', ['small', 'medium', 'large'])->default('medium');
            $table->json('resources_used')->nullable();
            $table->text('inspiration')->nullable();
            $table->text('follow_up_plans')->nullable();
            $table->boolean('is_part_of_chain')->default(false);
            $table->foreignId('previous_act_id')->nullable()->constrained('kindness_acts')->onDelete('set null');
            $table->string('estimated_completion_time')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_frequency')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->integer('points_earned')->default(0);
            $table->timestamps();
        });

        // Create recipients table for multiple recipients
        Schema::create('kindness_act_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kindness_act_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('relationship')->nullable();
            $table->boolean('has_verified')->default(false);
            $table->timestamps();
        });

        // Create collaborators table for multiple collaborators
        Schema::create('kindness_act_collaborators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kindness_act_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kindness_act_collaborators');
        Schema::dropIfExists('kindness_act_recipients');
        Schema::dropIfExists('kindness_acts');
    }
};
