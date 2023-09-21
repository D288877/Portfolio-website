<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quizzes_id'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quizzes_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
