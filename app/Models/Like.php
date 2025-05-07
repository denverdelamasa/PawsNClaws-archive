<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'like_id';
    protected $fillable = [
        'post_id', // ID of the liked post
        'user_id',  // ID of the user who liked the post
        'announcement_id',
        'event_id'
    ];

    /**
     * Define the relationship to the `Post` model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Define the relationship to the `Post` model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }

    /**
     * Define the relationship to the `User` model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Custom foreign and local keys
    }
}
