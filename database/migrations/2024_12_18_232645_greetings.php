<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_tutor_greeting_at')->nullable();
            $table->timestamp('last_mentor_greeting_at')->nullable();
            
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_tutor_greeting_at', 'last_mentor_greeting_at']);
        });
    }
};