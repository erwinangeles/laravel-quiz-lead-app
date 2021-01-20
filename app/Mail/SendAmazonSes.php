<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAmazonSes extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email_content;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_content)
    {
        $this->email_content = $email_content;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New submission from TinaBaljianFit.com')->from(env('SES_FROM_EMAIL'))->view('emails.formcapture')->with('email_content', $this->email_content);
    }
}
