<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizQuestion;

class ViewQuizController extends Controller
{
    //
    public function show($slug){
        $quiz = Quiz::where('slug', '=', $slug)->active()->firstOrFail();

        return view('public.quiz', compact('quiz'));
    }

    public function step($slug, $question){
        $currentStep = QuizQuestion::findOrFail($question);
        $quiz = Quiz::where('slug', '=', $slug)->first();

         // get previous step for quiz
         $previousStep =$quiz->questions()->where('id', '<', $currentStep->id)->max('id');
         // get next step for quiz
         $nextStep = $quiz->questions()->where('id', '>', $currentStep->id)->min('id');
         return view('public.step', compact('quiz', 'currentStep', 'previousStep', 'nextStep'));
    }

    public function complete($slug){
        $quiz = Quiz::where('slug', '=', $slug)->active()->firstOrFail();
        return view('public.complete', compact('quiz'));
    }

    public function thankyou(){
        return view('public.thankyou');
    }
}
