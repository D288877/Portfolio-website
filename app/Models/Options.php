<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;
    protected $fillable = [
        'questions_id',
        'option',
        'checkOption',
        'points'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
