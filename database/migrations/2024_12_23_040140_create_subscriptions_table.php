<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
}; 


// php artisan migrate --path=database/migrations/2024_12_23_040137_create_posts_table.php
// php artisan migrate --path=database/migrations/2024_12_23_040138_create_comments_table.php
// php artisan migrate --path=database/migrations/2024_12_23_040138_create_likes_table.php
// php artisan migrate --path=database/migrations/2024_12_23_040139_create_notifications_table.php
// php artisan migrate --path=database/migrations/2024_12_23_040140_create_subscriptions_table.php