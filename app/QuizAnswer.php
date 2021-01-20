<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    //
    protected $fillable = [
        'content',
    ];

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
