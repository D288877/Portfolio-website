<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'titel',
        'inhoud'
    ];

    public function User()
    {
        return $this->belongsTo(user::class);
    }
}
