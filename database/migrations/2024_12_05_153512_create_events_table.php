<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_events_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id'); // Primary Key
            $table->unsignedBigInteger('shelter_id'); // Make sure it's unsigned
            $table->foreign('shelter_id')->references('user_id')->on('users')->onDelete('cascade'); // Foreign Key constraint
            $table->string('event_name'); // Name of the event
            $table->text('event_description'); // Description of the event
            $table->dateTime('event_date'); // Event Date and Time
            $table->string('event_location'); // Location of the event
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
