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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'subscription_status')) {
                $table->string('subscription_status')->nullable()->after('subscription_name');
            }
            
            if (!Schema::hasColumn('users', 'subscription_end_date')) {
                $table->timestamp('subscription_end_date')->nullable()->after('subscription_status');
            }
            
            if (!Schema::hasColumn('users', 'paypal_subscription_id')) {
                $table->string('paypal_subscription_id')->nullable()->after('subscription_end_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['subscription_status', 'subscription_end_date', 'paypal_subscription_id']);
        });
    }
};
