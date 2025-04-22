<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyApplication extends Model
{
    // Specify the table name (optional if it matches the model name in plural form)
    protected $table = 'verify_applications';

    // Define the primary key
    protected $primaryKey = 'verify_id';

    // Specify which fields are mass assignable
    protected $fillable = [
        'user_id',
        'documents',
        'role'  
    ];

    // Enable timestamps for created_at and updated_at
    public $timestamps = true;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}