<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('locale', 10)->default('en');
            $table->char('country_code', 2)->default('ZA');
            $table->string('timezone')->default('Africa/Johannesburg');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['locale', 'country_code', 'timezone']);
        });
    }
};
