<?php

// app/Models/Foster.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foster extends Model
{
    use HasFactory;

    // Specify the table name (optional, if it follows Laravel's default plural naming convention)
    protected $table = 'fosters';

    // Specify the primary key (optional, as Laravel defaults to 'id')
    protected $primaryKey = 'foster_id';

    // Specify which columns are mass assignable
    protected $fillable = ['user_id', 'status', 'application_data'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the attribute to cast application_data as an array (if using JSON)
    protected $casts = [
        'application_data' => 'array',
    ];
}
