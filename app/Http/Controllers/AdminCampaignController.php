<?php

namespace App\Http\Controllers;

use App\Services\Campaign;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminCampaignController extends Controller
{
    public function index(Campaign $campaign): View
    {
        try {
            $response = $campaign->list();
        } catch (ClientException $e) {
            throw $e;
        }

        return View('admin.campaigns.index', [
            'campaigns' => $response->campaigns
        ]);
    }

    public function send(Campaign $campaign, string $id): RedirectResponse
    {


        try {
            $campaign->send($id);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/admin/campaigns')->with('success', 'Campaign sent!');
    }

    public function delete(Campaign $campaign, string $id): RedirectResponse
    {
        try {
            $campaign->delete($id);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/admin/campaigns')->with('success', 'Campaign deleted!');
    }

    public function create(): View
    {
        return View('admin.campaigns.create');
    }

    public function store(Campaign $campaign): RedirectResponse
    {
        $email = request()->user()->email;

        $attributes = request()->validate([
            'type' => 'required',
            'title' => 'required',
            'subject' => 'required',
        ]);

        try {
            $campaign->store($attributes['type'], $attributes['subject'], $attributes['title'], $email);
        } catch (ClientException $e) {
            throw $e;
        }

        return redirect('/admin/campaigns')->with('success', 'Campaign created!');
    }

    public function edit(string $campaign): View
    {
        return View('admin.campaigns.edit', [
            'campaign' => $campaign
        ]);
    }
}
