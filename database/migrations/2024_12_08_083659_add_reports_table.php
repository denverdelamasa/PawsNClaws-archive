<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->unsignedBigInteger('user_id'); // User who reported
            $table->unsignedBigInteger('post_id')->nullable(); // Nullable for comments
            $table->unsignedBigInteger('comment_id')->nullable(); // Nullable for posts
            $table->string('reason'); // Reason for the report
            $table->text('details')->nullable(); // Custom details if available (for 'Other' reports)
            $table->enum('type', ['post', 'comment']); // Whether the report is about a post or comment
            $table->timestamps();

            // Foreign key relations
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
            $table->foreign('comment_id')->references('comment_id')->on('comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
