<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    //

    protected $fillable = [
        'prompt',
        'allowCustomAnswer'
    ];

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
