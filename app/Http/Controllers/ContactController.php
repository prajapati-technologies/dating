<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail; // or use Notifications

class ContactController extends Controller
{
    public function show() { return view('pages.contact'); }

    public function send(Request $r)
    {
        $r->validate([
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required|min:10'
        ]);

        // Save or send email
        // Mail::to(config('mail.from.address'))->send(new \App\Mail\ContactMail($r->only('name','email','message')));

        return back()->with('success','Message sent. We will contact you soon.');
    }
}
