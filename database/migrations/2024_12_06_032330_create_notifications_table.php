<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id'); // Custom primary key for the notification
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('type'); // Type of the notification
            $table->text('data'); // Data associated with the notification (JSON)
            $table->timestamp('read_at')->nullable(); // Timestamp when the notification was read
            $table->timestamps(); // Created and updated timestamps
            
            // Foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}