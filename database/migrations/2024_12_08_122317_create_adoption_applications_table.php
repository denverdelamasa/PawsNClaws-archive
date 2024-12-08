<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('adoption_applications', function (Blueprint $table) {
            $table->id('application_id'); // Primary key for the adoption application
            $table->unsignedBigInteger('user_id'); // Foreign key to the users table (the post owner)
            $table->unsignedBigInteger('post_id'); // Foreign key to the posts table (the post being adopted)
            $table->string('adopter_name'); // Full Name of the applicant
            $table->string('contact_info'); // Contact Info (Phone or Email)
            $table->enum('adopt_type', ['individual', 'organization', 'shelter']); // Who is applying
            $table->enum('employment_status', ['student', 'employed', 'volunteer']); // Employment status
            $table->string('socmed')->nullable(); // Social Media Links (optional)
            $table->string('location'); // Complete location of the applicant
            $table->text('experience'); // Experience with pets
            $table->text('reason'); // Reason for adopting
            $table->unsignedInteger('current_pets'); // Number of current pets
            $table->string('gov_id'); // Path to the uploaded government ID
            $table->timestamps(); // Created at & Updated at timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('adoption_applications');
    }
}
