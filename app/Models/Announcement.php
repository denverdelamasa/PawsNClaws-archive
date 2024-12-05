<?php

// app/Models/Announcement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Specify the table name (optional, if it follows Laravel's default plural naming convention)
    protected $table = 'announcements';

    // Specify the primary key (optional, as Laravel defaults to 'id')
    protected $primaryKey = 'announcement_id';

    // Specify which columns are mass assignable (optional)
    protected $fillable = ['shelter_id', 'announcement_title', 'announcement_description'];

    // Define the relationship with the User model (shelter_id refers to user_id)
    public function shelter()
    {
        return $this->belongsTo(User::class, 'shelter_id', 'user_id');
    }
}
