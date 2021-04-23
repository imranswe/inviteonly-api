<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'email', 'token', 'accepted',
        'accepted_at',
    ];

    public function generateToken() {
        return substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }
}
