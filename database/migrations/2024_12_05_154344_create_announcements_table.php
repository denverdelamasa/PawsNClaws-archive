<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_announcements_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id('announcement_id'); // Primary Key
            $table->unsignedBigInteger('shelter_id'); // Foreign Key to users table (user_id)
            $table->foreign('shelter_id')->references('user_id')->on('users')->onDelete('cascade'); // Foreign Key Constraint
            $table->string('announcement_title'); // Title of the announcement
            $table->text('announcement_description'); // Description of the announcement
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
