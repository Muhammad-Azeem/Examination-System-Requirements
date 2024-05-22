<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['user_attempt_id', 'question_id', 'answer', 'is_correct'];

    public function userAttempt()
    {
        return $this->belongsTo(UserAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
