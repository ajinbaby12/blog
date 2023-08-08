<?php

namespace App\Http\Controllers;

use App\Services\MailchimpNewsletter;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(MailchimpNewsletter $newsletter) // Laravel auto resolves and creates a Newsletter object which in turn depends on an ApiClient class
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'The given email could not be added'
            ]);
        }

        return redirect('/')->with('success', 'You are now subscribed');
    }
}
