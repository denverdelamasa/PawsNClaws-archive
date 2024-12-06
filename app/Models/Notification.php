<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'notifications';

    // Specify which fields can be mass-assigned
    protected $fillable = [
        'user_id',   // Assuming the user associated with the notification
        'type',      // The type of the notification (e.g., 'info', 'warning', etc.
        'read_at',   // To mark the notification as read or unread (nullable)
    ];

    // Optionally, you can define relationships if needed (e.g., a user has many notifications)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, add any custom methods or accessor/mutators if needed
}
