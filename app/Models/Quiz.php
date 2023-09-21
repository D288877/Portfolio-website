<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_data'
    ];

    public function results()
    {
        return $this->hasMany(QuizResult::class, 'quizzes_id');
    }
}
