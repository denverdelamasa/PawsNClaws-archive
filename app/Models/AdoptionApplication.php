<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionApplication extends Model
{
    use HasFactory;

    // Define the table name (if different from pluralized model name)
    protected $table = 'adoption_applications';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'application_id';

    // Define the fillable attributes (to protect against mass assignment)
    protected $fillable = [
        'receiver_id',
        'post_id',
        'sender_id',
        'adopter_name',
        'contact_info',
        'adopt_type',
        'employment_status',
        'socmed',
        'location',
        'experience',
        'reason',
        'current_pets',
        'gov_id',
        'status',
        'adoption_id'
    ];

    // Define the relationships

    /**
     * Get the user associated with the adoption application (the post owner).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post associated with the adoption application.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'user_id');
    }

    /**
     * Get the sender user associated with the adoption application.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'user_id');
    }
}
