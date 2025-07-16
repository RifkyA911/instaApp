<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            // posts table
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('caption')->nullable();
            $table->string('image_path');
            $table->timestamps();
            // $table->unsignedBigInteger('likes_count')->default(0);
            // $table->unsignedBigInteger('comments_count')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('shares_count')->default(0);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('reported_count')->default(0);
            $table->unsignedBigInteger('reactions_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
