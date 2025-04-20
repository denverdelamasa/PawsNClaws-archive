<?php

// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Specify the table name (optional, if it follows Laravel's default plural naming convention)
    protected $table = 'events';

    // Specify the primary key (optional, as Laravel defaults to 'id')
    protected $primaryKey = 'event_id';

    protected $casts = [
        'event_thumbnail' => 'array', // Cast JSON column to an array
    ];

    // Specify which columns are mass assignable (optional)
    protected $fillable = ['shelter_id', 'event_title', 'event_description', 'event_start_date', 'event_end_date', 'event_location', 'event_thumbnail'];

    // Define the relationship with the User model (shelter_id refers to user_id)
    public function shelter()
    {
        return $this->belongsTo(User::class, 'shelter_id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'event_comment_id', 'event_id');
    }
}
