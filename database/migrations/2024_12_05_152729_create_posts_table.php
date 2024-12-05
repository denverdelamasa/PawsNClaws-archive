<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Make sure it's unsigned big integer
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Foreign Key constraint
            $table->string('image_path')->nullable(); // File path for image
            $table->text('caption')->nullable(); // Caption
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
