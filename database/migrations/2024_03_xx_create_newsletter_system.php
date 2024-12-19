<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->text('preview_html')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('newsletter_subscribed')->default(false);
            $table->timestamp('newsletter_subscribed_at')->nullable();
            $table->string('newsletter_token')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletters');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['newsletter_subscribed', 'newsletter_subscribed_at', 'newsletter_token']);
        });
    }
}; 