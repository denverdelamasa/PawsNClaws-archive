<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_fosters_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFostersTable extends Migration
{
    public function up()
    {
        Schema::create('fosters', function (Blueprint $table) {
            $table->id('foster_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->enum('status', ['pending', 'approved', 'rejected']); // Status field
            $table->text('application_data'); // Store application details as JSON/Text
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint for user_id (references id in users table)
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fosters');
    }
}
