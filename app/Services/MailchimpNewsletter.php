<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter
{

    public function __construct(protected ApiClient $client) // Dependency injection. Read register() of AppServiceProvider
    {

    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }

    // protected function client()
    // {
    //     return $this->client->setConfig([ // $this->client points to an ApiClient object
    //         'apiKey' => config('services.mailchimp.key'),
    //         'server' => 'us12'
    //     ]);
    // } // Moved this section into AppServiceProvider
}

?>
