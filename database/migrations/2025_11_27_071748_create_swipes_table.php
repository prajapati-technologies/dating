<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('swipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');      // Who swiped
            $table->unsignedBigInteger('target_id');    // On whom swipe was done
            $table->enum('type', ['like', 'dislike']);  // Like or Dislike
            $table->timestamps();

            // Foreign keys (optional but recommended)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');

            // Prevent duplicate swipe
            $table->unique(['user_id', 'target_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('swipes');
    }
};
