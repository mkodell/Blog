<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function guestSubscribe(Newsletter $newsletter): RedirectResponse
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->firstSubscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up to receive updates');
    }

    public function userResubscribe(Newsletter $newsletter): RedirectResponse
    {
        $user = request()->user()->username;
        $email = request()->user()->email;

        try {
            $newsletter->resubscribe($email);
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/account/' . $user)->with('success', 'You are now signed up to receive updates');
    }

    public function unsubscribe(Newsletter $newsletter): RedirectResponse
    {
        $user = request()->user()->username;
        $email = request()->user()->email;

        try {
            $newsletter->unsubscribe($email);
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'user' => 'This email could not be removed from our newsletter list.'
            ]);
        }

        return redirect('/account/' . $user)->with('success', 'You will no longer receive updates');
    }

    public function userNewSubscribe(Newsletter $newsletter): RedirectResponse
    {
        $user = request()->user()->username;
        $email = request()->user()->email;

        try {
            $newsletter->firstSubscribe($email);
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/account/' . $user)->with('success', 'You are now signed up to receive updates');
    }

    public function listCampaigns(Newsletter $newsletter)
    {
        try {
            $response = $newsletter->listCampaigns();
        } catch (Exception $e) {
            throw $e;
        }

        return View('admin.campaigns.index', [
            'campaigns' => $response->campaigns
        ]);
    }

    public function sendCampaign(Newsletter $newsletter, string $campaign): RedirectResponse
    {
        try {
            $newsletter->sendCampaign($campaign);
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'user' => 'This email could not be removed from our newsletter list.'
            ]);
        }

        return redirect('/newsletter/listCampaigns')->with('success', 'Campaign sent!');
    }

    public function deleteCampaign(Newsletter $newsletter, string $campaign): RedirectResponse
    {
        try {
            $newsletter->deleteCampaign($campaign);
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'user' => 'This email could not be removed from our newsletter list.'
            ]);
        }

        return redirect('/newsletter/listCampaigns')->with('success', 'Campaign deleted!');
    }
}
