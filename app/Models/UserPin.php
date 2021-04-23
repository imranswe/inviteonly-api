<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'code', 'used'
    ];

    /**
     * Get the user that owns UserPin.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
