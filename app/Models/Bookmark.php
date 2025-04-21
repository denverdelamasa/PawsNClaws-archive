<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $primaryKey = 'bookmark_id';

    protected $fillable = [
        'user_id',
        'post_id',
        'event_id',
        'announcement_id',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function announcement() {
        return $this->belongsTo(Announcement::class);
    }
}
