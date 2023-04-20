<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected ApiClient $client)
    {

    }

    public function firstSubscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    public function unsubscribe(string $email, string $list = null)
    {
        // $user = request()->user()->email;
        $list ??= config('services.mailchimp.lists.subscribers');
        $hash = md5(strtolower($email));

        return $this->client->lists->updateListMember($list, $hash, [
            'status' => 'unsubscribed'
        ]);
    }

    public function checkStatus(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
        $hash = md5(strtolower($email));

        return $this->client->lists->getListMember($list, $hash);
    }

    public function resubscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
        $hash = md5(strtolower($email));

        return $this->client->lists->updateListMember($list, $hash, [
            'status' => 'subscribed'
        ]);
    }

    public function listCampaigns()
    {
        return $this->client->campaigns->list();
    }

    public function sendCampaign(string $campaign): void
    {
        $this->client->campaigns->send($campaign);
    }

    public function deleteCampaign(string $campaign): void
    {
        $this->client->campaigns->remove($campaign);
    }
}
