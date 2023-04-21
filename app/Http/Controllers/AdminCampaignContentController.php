<?php

namespace App\Http\Controllers;

use App\Services\Campaign;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\RedirectResponse;

class AdminCampaignContentController extends Controller
{
    public function store(Campaign $campaign, string $id): RedirectResponse
    {
        $attributes = request()->validate([
            'content' => 'required',
        ]);

        try {
            $campaign->storeContent($id, $attributes['content']);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/admin/campaigns')->with('success', 'Campaign content created!');
    }
}
