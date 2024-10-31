<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        //dd($this->details);
        // return $this->from($this->details['email'], $this->details['name'])
        //     ->subject($this->details['subject'])
        //     ->view('emails.contact');
        return $this->view('emails.contact')
        ->subject($this->details['subject'])
        ->withSwiftMessage(function ($message) 
        {
            $message->setFrom([$this->details['email'] => $this->details['name']]);
        });
    }
}
