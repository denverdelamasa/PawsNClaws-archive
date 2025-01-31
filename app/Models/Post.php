<?php

// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define the table name (optional, if not matching the plural form of the model)
    protected $table = 'posts';

    // Define the primary key (optional, if not 'id')
    protected $primaryKey = 'post_id';

    // Specify which columns are mass assignable (optional, for mass assignment protection)
    protected $fillable = ['user_id', 'image_path', 'caption', 'post_path'];

    protected $casts = [
        'image_path' => 'array', // Cast JSON column to an array
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    public function getUsernameAttribute()
    {
        return $this->user ? $this->user->username : null;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_comment_id', 'post_id');
    }
}
