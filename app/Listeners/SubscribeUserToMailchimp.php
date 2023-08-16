<?php

namespace App\Listeners;

use App\Services\Newsletter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use MailchimpMarketing\ApiClient;

class SubscribeUserToMailchimp
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $key;
    public $listId;

    public function __construct()
    {
        $this->key = config('services.mailchimp.key');
        $this->listId = config('services.mailchimp.lists.subscribers');
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $client = new ApiClient();
        $client->setConfig([
            'apiKey' => $this->key,
            'server' => 'us12',
        ]);

        $client->lists->addListMember($this->listId, [
            "email_address" => $event->user->email,
            "status" => "subscribed",
        ]);
    }
}
