<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $primaryKey = 'conversation_id';

    protected $table = 'conversations';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'application_id',
    ];

    /**
     * Get the first user in the conversation.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the second user in the conversation.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'user_id');
    }

    /**
     * Get the adoption application associated with the conversation.
     */
    public function application()
    {
        return $this->belongsTo(AdoptionApplication::class, 'application_id', 'application_id');
    }

    /**
     * Get the messages in the conversation.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'conversation_id');
    }
}