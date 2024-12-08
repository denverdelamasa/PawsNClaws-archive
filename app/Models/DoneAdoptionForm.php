<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoneAdoptionForm extends Model
{
    use HasFactory;

    protected $primaryKey = 'done_id';
    protected $table = 'done_adoption_forms';

    protected $fillable = [
        'done_user_id',
        'done_post_id',
        'status',
    ];

    /**
     * Get the user that owns the adoption form.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that the adoption form is associated with.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
