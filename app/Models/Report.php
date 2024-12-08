<?php
// app/Models/Report.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'reports';

    // Specify the primary key (optional, as Laravel defaults to 'id')
    protected $primaryKey = 'report_id';

    // Specify the fillable columns
    protected $fillable = ['user_id', 'post_id', 'comment_id', 'reason', 'details', 'type'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship with the Post model (only if the report is about a post)
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    // Define the relationship with the Comment model (only if the report is about a comment)
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
