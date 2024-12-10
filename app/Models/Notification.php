<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'notifications';

    protected $primaryKey = 'notification_id';

    // Specify which fields can be mass-assigned
    protected $fillable = [
        'user_id',   // Assuming the user associated with the notification
        'type',      // The type of the notification (e.g., 'info', 'warning', etc.
        'read_at',   // To mark the notification as read or unread (nullable)
        'post_id',
        'liked_by_user_id'
    ];

    // Optionally, you can define relationships if needed (e.g., a user has many notifications)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liker()
    {
        return $this->belongsTo(User::class, 'liked_by_user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Optionally, add any custom methods or accessor/mutators if needed
}
