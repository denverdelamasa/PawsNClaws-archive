<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_comments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->unsignedBigInteger('post_comment_id')->nullable(); // Foreign Key to posts table
            $table->unsignedBigInteger('event_comment_id')->nullable(); // Foreign Key to events table
            $table->unsignedBigInteger('announcement_comment_id')->nullable(); // Foreign Key to announcements table
            $table->text('comment'); // The comment itself
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint for user_id (references id in users table)
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            // Foreign key constraints for the post, event, and announcement
            $table->foreign('post_comment_id')->references('post_id')->on('posts')->onDelete('cascade');
            $table->foreign('event_comment_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('announcement_comment_id')->references('announcement_id')->on('announcements')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
