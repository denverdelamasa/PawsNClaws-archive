<?php
// app/Models/Comment.php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\CommentReply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    // Specify the table name (optional, if it follows Laravel's default plural naming convention)
    protected $table = 'comments';

    // Specify the primary key (optional, as Laravel defaults to 'id')
    protected $primaryKey = 'comment_id';

    // Specify which columns are mass assignable
    protected $fillable = ['user_id', 'post_comment_id', 'event_comment_id', 'announcement_comment_id', 'comment'];

    // Define the relationship with the User model (who made the comment)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship to the Post model
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_comment_id');
    }

    // Define the relationship to the Event model
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_comment_id');
    }

    // Define the relationship to the Announcement model
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_comment_id');
    }
    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }
}
