<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizAnswer;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAmazonSes;

class NotificationEmailController extends Controller
{
    //
    public function sendMail($id, Request $request){
        $quiz = Quiz::findOrFail($id);
        $email_content = "<h3>" . $request->get('name') . " - " . $request->get('email') . "</h3><p>Quiz Answers</p>";
        foreach($quiz->questions as $q){
            $a = QuizAnswer::where('id', '=', $request->get($q->id))->first();
            if($a == null){
                $a = str_replace('CUSTOM-', '', $request->get($q->id));
            }else{
                $a = $a->content;
            }
            $email_content .= "<p><strong>" . $q->prompt . "</strong></p>" . $a;
        }
        Mail::to(env('SES_TO_EMAIL'))->send(new SendAmazonSes($email_content));
        return 'Thanks for submitting. We will be in touch';
    }
}
