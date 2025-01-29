<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat_service_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('service_provider', ['Pusher', 'Firebase', 'Firestore']);
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('project_id')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_service_settings');
    }
};
