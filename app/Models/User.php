<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_picture',
        'role',
        'status',
        'bio'
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'suspended_until' => 'datetime',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'user_id'); // Custom foreign and local keys
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }
    
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'sender_id', 'user_id')
                    ->orWhere('receiver_id', 'user_id');
    }
    
    /**
     * Get the messages sent by the user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'user_id');
    }
    public function verificationApplications()
    {
        return $this->hasMany(VerifyApplication::class, 'user_id', 'user_id');
    }
}
