<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['user_attempt_id', 'message'];

    public function userAttempt()
    {
        return $this->belongsTo(UserAttempt::class);
    }
}
