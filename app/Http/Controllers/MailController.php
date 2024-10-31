<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendContactMail(Request $request)
    {
        $fields = $request->validate
        ([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['max:255'],
            'body' => ['required']
        ]);

        
        Mail::to('s.elliot.perez@gmail.com')->send(new ContactMail($fields));
    
        return back()->with('success', 'your message has been sent- thank you.');
    }
}
