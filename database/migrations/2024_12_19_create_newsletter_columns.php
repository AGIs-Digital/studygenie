<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'newsletter_subscribed')) {
                $table->boolean('newsletter_subscribed')->default(true)->nullable();
            }
            if (!Schema::hasColumn('users', 'newsletter_token')) {
                $table->string('newsletter_token')->nullable();
            }
            if (!Schema::hasColumn('users', 'newsletter_unsubscribed_at')) {
                $table->timestamp('newsletter_unsubscribed_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['newsletter_subscribed', 'newsletter_token', 'newsletter_unsubscribed_at']);
        });
    }
}; 