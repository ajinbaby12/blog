<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MailchimpMarketing\ApiClient;

class NewsletterController extends Controller
{
    public function test()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $newsletter = new ApiClient();

        $newsletter->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us12'
        ]);

        try {
            $newsletter->lists->addListMember("f52a440899", [
                "email_address" => request('email'),
                "status" => "subscribed",
            ]);
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'The given email could not be added'
            ]);
        }


        return redirect('/')->with('success', 'You are now subscribed');
    }
}
