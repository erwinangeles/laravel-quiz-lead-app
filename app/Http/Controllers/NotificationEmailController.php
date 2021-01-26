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
        $online_or_in_person = null;
        $email_content = "<h3>" . $request->get('name') . " - " . $request->get('email') . "</h3><p>Quiz Answers</p>";
        foreach($quiz->questions as $q){
            $a = QuizAnswer::where('id', '=', $request->get($q->id))->first();
            if($a == null){
                $a = str_replace('CUSTOM-', '', $request->get($q->id));
            }else{
                $a = $a->content;
            }
            $email_content .= "<p><strong>" . $q->prompt . "</strong></p>" . $a;

            if($a == "I want to workout in a gym"){
                $online_or_in_person = 'in-person';
            }
            if($a == "I'm looking for an at home workout program"){
                $online_or_in_person = 'online';
            }
        }
        $recipient = env("SES_TO_EMAIL");
        Mail::to($recipient)->bcc(env("SES_ADMIN_EMAIL"), env("COMPANY_NAME"))->send(new SendAmazonSes($email_content));

        if($online_or_in_person == 'in-person'){
            $url = env("INPERSON_URL_REDIRECT");

            $html = "<p>You should be automatically redirected to your recommended plan. Click <a href='" . $url. "' target='_blank'>here</a> if you don't see the new window</p>";
            return $html;
        }

        if($online_or_in_person == 'online'){
            $url = env("ONLINE_URL_REDIRECT");
            $html = "<p>You should be automatically redirected to your recommended plan. Click <a href='" . $url. "' target='_blank'>here</a> if you don't see the new window</p>";
            return $html;
        }
        return 'Thanks for submitting. We will be in touch';
    }
}
