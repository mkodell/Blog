<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpCampaign implements Campaign
{
    public function __construct(protected ApiClient $client)
    {

    }

    public function list()
    {
        return $this->client->campaigns->list();
    }

    public function send(string $campaign): void
    {
        $this->client->campaigns->send($campaign);
    }

    public function delete(string $campaign): void
    {
        $this->client->campaigns->remove($campaign);
    }

    public function store(string $type, string $subject, string $title, string $user): void
    {
        $list = config('services.mailchimp.lists.subscribers');

        $this->client->campaigns->create(['type' => $type,
            'recipients' => [
                'list_id' => $list
            ],
            'settings' => [
                'subject_line' => $subject,
                'title' => $title,
                'reply_to' => $user,
            ],
        ]);
    }

    public function storeContent(string $campaign, string $content): void
    {
        $this->client->campaigns->setContent($campaign, [
            'plain_text' => $content
        ]);
    }
}
