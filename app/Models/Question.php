<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['paper_id', 'type', 'question_text', 'options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }
}
