<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QuizQuestion;

class Quiz extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'active'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
